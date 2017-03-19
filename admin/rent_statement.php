<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php"); 
Session::confirm_logged_in('login_user');

    require_once './header.php';
    ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">View Received Rent</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-69">
                    <!--    Striped Rows Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">

                                <?php
                                $sql = "SELECT p.plot_id, p.lid, t.fname, t.room_number, t.natid, l.lid, "
                                        . " r.id, r.natid, r.rent_amount, r.rent_due, r.month_paid_for, r.time_paid, r.added_by"
                                        . " FROM rent r, plots p, landlords l, tenants t"
                                        . " WHERE t.natid = r.natid AND l.lid=p.lid AND t.plot_id=p.plot_id AND r.t=1";
                                $res = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($res == true) {
                                    ?>

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Plot ID</th>
                                                <th>House ID</th>
                                                <th>Month Paid</th>
                                                <th>Payment date</th>
                                                <th>Received by</th>
                                                <th>Amount</th>
                                                <th>Rent Due</th>
                                                <!--<th>State</th>-->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            foreach ($res as $row) {

                                                $i++;
                                                $total += ($row["rent_amount"]);
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row["fname"] ?></td>
                                                    <td><?php echo $row["plot_id"] ?></td>
                                                    <td><?php echo $row["room_number"] ?></td>
                                                    <td><?php echo $row["month_paid_for"] ?></td>
                                                    <td><?php echo $row["time_paid"] ?></td>
                                                    <td><?php echo $row["added_by"] ?></td>
                                                    <td><?php echo $row["rent_amount"] ?></td> 
                                                    <td><?php echo $row["rent_due"] ?></td>
                                                    <td>
                                                        <div class="col-sm-6">
                                                            <button onclick="overwrite_txn('<?php echo $row["id"]
                                                ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Overwrite Transaction</button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <script>
                                                function overwrite_txn(id) {
                                                    if (confirm("Overwrite Transaction!Are you sure?")) {
                                                        window.location.href = 'rent_statement.php?i=' + id + '&olo=gjytfjhtfjyhgjtydhgtf';
            //                                                        alert('rent_statement.php?i=' + id + '&olo=gjytfjhtfjyhgjtydhgtf');
                                                    }
                                                }
                                            </script>
                                            <?php
                                        }
                                        ?>
                                            <!--<tr><td colspan="8" style="text-align: center;">Total rent:</td><th><?php echo $total; ?></th></tr>-->
                                        <?php
                                        if (isset($_GET['i'])) {
                                            $j = $_GET['i'];
                                            echo $j;
                                            $sql = "UPDATE `rent` SET `t` = '0' WHERE `rent`.`id` = $j";
                                            $res = mysqli_query($conn, $sql);
                                            if ($res == true) {
                                                echo $i . 'Overwritten';
//                                                echo '<script> alert ("Entry Overwritten Successfully!!");</script>';
                                                echo '<script> window.location.href=\'rent_statement.php\';</script>';
                                            } else {
                                                echo 'WRONG SQL';
                                                echo "very wrong", mysqli_error($conn);
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } else {
                                    echo "very wrong", mysqli_error($conn);
                                }
                                ?> 

                            </div>

                        </div>

                    </div> 

                    <!--  End  Striped Rows Table  -->
                </div>

            </div>



        </div>
    </div>	
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php
    require_once './footer.php';

    