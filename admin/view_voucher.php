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
                    <h1 class="page-head-line">View Voucher</h1>
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
                                $sql = "SELECT * FROM `vouchers` WHERE t=1 ORDER BY `id` DESC";
                                $res = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($res == true) {
                                    ?>

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Date incurred</th>
                                                <th>Added by</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($res as $row) {

                                                $i++;
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row["title"] ?></td>
                                                    <td><?php echo $row["date_added"] ?></td>
                                                    <td><?php echo $row["added_by"] ?></td>
                                                    <td style="text-align: right;"><?php echo $row["amount"] ?> /=</td>
                                                    <td>
                                                        <div class="">
                                                            <button onclick="overwrite_txn('<?php echo $row["id"]
                                                ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Overwrite Transaction</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                        <script>
                                            function overwrite_txn(id) {
                                                if (confirm("Overwrite Transaction!Are you sure?")) {
                                                    window.location.href = 'view_voucher.php?i=' + id + '&olo=gjytfjhtfjyhgjtydhgtf';
                                                    alert('view_voucher.php?i=' + id + '&olo=gjytfjhtfjyhgjtydhgtf');
                                                }
                                            }
                                        </script>
                                        <?php
                                        if (isset($_GET['i'])) {
                                            $j = $_GET['i'];
                                            echo $j;
                                            $sql = "UPDATE `vouchers` SET `t` = '0' WHERE `vouchers`.`id` = $j";
                                            $res = mysqli_query($conn, $sql);
                                            if ($res == true) {
                                                echo $i . 'Overwritten';
                                                echo '<script> alert ("Entry Overwritten Successfully!!");</script>';
                                                echo '<script> window.location.href=\'view_voucher.php\';</script>';
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
                                    echo '<script type="text/javascript"> alert ("Account successfully Created!!!");' . ' ' .
                                    '';
                                    echo "very wrong";
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

    
    