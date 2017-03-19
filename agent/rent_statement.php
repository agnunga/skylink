<?php
require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 

require_once './header.php';
?>

<!--  page-wrapper -->
<div id="page-wrapper">


    <div class="row">
        <!--  page header -->
        <div class="col-lg-12">
            <h1 class="page-header">Rent Statement</h1>
        </div>
        <!-- end  page header -->
    </div> 
    <div class="row">
        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">


                    <div class="table-responsive">

                        <?php
                        $sql = "SELECT p.plot_id, p.lid, t.fname, t.room_number, t.natid, l.lid, "
                                . " r.natid, r.rent_amount, r.rent_due, r.month_paid_for, r.time_paid, r.added_by"
                                . " FROM rent r, plots p, landlords l, tenants t"
                                . " WHERE t.natid = r.natid AND l.lid=p.lid AND t.plot_id=p.plot_id";
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
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                            <!--<tr><td colspan="8" style="text-align: center;">Total rent:</td><th><?php echo $total; ?></th></tr>-->
                                    <?php
                                    if (isset($_GET['i'])) {
                                        $j = $_GET['i'];
                                        echo $j;
                                        $sql = "DELETE FROM `plots` WHERE `id` = $j";
                                        $res = mysqli_query($conn, $sql);
                                        if ($res == true) {
                                            echo $i . 'Deleted';
                                            echo '<script> alert ("Entry Deleted Successfully!!"); window.location.href=\'view_property.php\';</script>';
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
        </div>
        <!--End Advanced Tables -->
    </div>
</div>

<?php
require_once './footer.php';


