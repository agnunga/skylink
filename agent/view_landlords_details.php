<?php
require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 

require_once './header.php';

if (isset($_POST['details'])) {
    $lid = $_POST['lid'];
    ?>
    <!--  page-wrapper -->
    <div id="page-wrapper">


        <div class="row">
            <!--  page header -->
            <div class="col-lg-12">
                <h1 class="page-header">


                    <?php
                    $sql0 = "SELECT * FROM `landlords` WHERE lid = '$lid' LIMIT 1";
                    $sql = "SELECT "
                            . " p.plot_id, p.estate, p.lid, p.room_no, p.commission, p.added_by, p.date_added, "
                            . " l.id, l.fname, l.lid"
                            . " FROM plots p, landlords l"
                            . " WHERE p.lid = l.lid"
                            . " AND l.lid = '$lid'"
                            . " AND l.lid = '$lid'";


                    $res = mysqli_query($conn, $sql);
                    $res0 = mysqli_query($conn, $sql0);
                    $i = 0;
                    if ($res0 == true) {
                        ?>
                        <?php
                        foreach ($res0 as $row) {
                            echo "List of Plots owned by: " . $row['fname'] . " - ";
                            echo $row['lid'];
                        }
                        ?>

                    </h1>
                </div>
                <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <form class="panel panel-default" method="POST" action="view_vacants.php">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Plot Code</th>
                                            <th>No of Rooms</th>
                                            <th>Estate</th>
                                            <th>Commission</th>
                                            <th>Added by</th>
                                            <th>Date added</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($res as $row) {

                                            $i++;
                                            ?>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["plot_id"] ?></td>
                                                <td><?php echo $row["room_no"] ?></td>
                                                <td><?php echo $row["estate"] ?></td>
                                                <td><?php echo $row["commission"] ?></td>
                                                <td><?php echo $row["added_by"] ?></td>
                                                <td><?php echo $row["date_added"] ?></td>
                                            </tr>
                                            <?php
                                        }


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
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                echo "wrong", mysqli_error($conn);
                            }
                            ?> 

                        </div>

                        <div style="text-align: right">
                            <input type="submit" name="update" value="UPDATE" class="btn btn-primary">
                        </div>
                    </div>
                </form>
                <!--End Advanced Tables -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <!--   Kitchen Sink -->

            </div>
        </div>

    </div>

    <?php
} else {
    echo 'Not Allowed.';
}
require_once './footer.php';


