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
            <h1 class="page-header">The List of Occupied</h1>
        </div>
        <!-- end  page header -->
    </div>
    <div class="col-lg-12">
        <div class="row">
            <!-- Advanced Tables -->
            <div class="panel panel-default">

                <div class="" style="text-align: right;">
                    <a href="view_vacants.php">View vacant rooms </a>

                </div>
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql = "SELECT r.room_number, r.plot_id, r.status, r.room_type, r.rent, p.lid, p.plot_id, p.estate"
                                . " FROM rooms r, plots p "
                                . "WHERE r.status='1' AND r.plot_id = p.plot_id ORDER BY r.id ASC ";
                        $res = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($res == true) {
                            ?>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Vacant rooms No</th>
                                        <th>Plot Code</th>
                                        <th>Estate</th>
                                        <th>Rent per room</th>
                                        <th>Owner</th>
                                        <th>Room type</th>
                                        <th>State</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($res as $row) {

                                        $i++;
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row["room_number"] ?></td>
                                            <td><?php echo $row["plot_id"] ?></td>
                                            <td><?php echo $row["estate"] ?></td>
                                            <td><?php echo $row["rent"] ?></td>
                                            <td><?php echo $row["lid"] ?></td>
                                            <td><?php echo $row["room_type"] ?></td>
                                            <td><?php echo $row["status"] ?></td>
                                        </tr>
                                        <?php
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
require_once './footer.php';


