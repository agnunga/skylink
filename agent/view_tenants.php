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
            <h1 class="page-header" style="text-align: center">
                Our Current Tenants
            </h1>
        </div>
        <!-- end  page header -->
    </div>
    <div class="row">

        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="" style="text-align: right;">
                    <a href="view_past_tenants.php">View past tenants</a>

                </div>
                <div class="panel-heading">
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql = "SELECT r.room_number, r.plot_id, r.status, r.room_type, r.rent, p.lid, p.plot_id, p.estate, "
                                . " t.id, t.fname, t.natid, t.phone, t.plot_id, t.room_number, t.added_by, t.created_at, t.modified_by, t.modified_at, t.nok_name, t.nok_phone, t.place_of_wrk, t.t "
                                . " FROM rooms r, plots p, tenants t "
                                . " WHERE r.status='1' AND r.plot_id = p.plot_id AND r.plot_id = t.plot_id  AND r.room_number = t.room_number AND t.t=1  ORDER BY r.id ASC ";
                        $res = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($res == true) {
                            ?>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tenant's name</th>
                                        <th>ID</th>
                                        <th>Phone</th>
                                        <th>RoomNo</th>
                                        <th>Plot Code</th>
                                        <th>Estate</th>
                                        <th>Rent</th>
                                        <th>Owner</th>
                                        <th>Room type</th>
                                        <th>Kin Phone</th>
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
                                            <td><?php echo $row["fname"] ?></td>
                                            <td><?php echo $row["natid"] ?></td>
                                            <td><?php echo $row["phone"] ?></td>
                                            <td><?php echo $row["room_number"] ?></td>
                                            <td><?php echo $row["plot_id"] ?></td>
                                            <td><?php echo $row["estate"] ?></td>
                                            <td><?php echo $row["rent"] ?></td>
                                            <td><?php echo $row["lid"] ?></td>
                                            <td><?php echo $row["room_type"] ?></td>
                                            <td><?php echo $row["nok_phone"] ?></td>
                                            <td>
                                                <div class="">
                                                    <button onclick="clear_tenant('<?php echo $row["id"]; ?>', '<?php echo $row["plot_id"]; ?>', '<?php echo $row["room_number"]; ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Clear</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                <script>
                                    function clear_tenant(id, pid, rno) {
                                        if (confirm("Clear Tenant! Are you sure?")) {
                                            window.location.href = 'view_tenants.php?i=' + id + '&olo=gjytfjhtfjyhgjtydhgtf&p=' + pid + '&pokoi=hmjhgfhng&r=' + rno + '&gfb=htfhtfhmtf';
    //                                                alert('view_tenants.php?i=' + id + '&p=' + pid + '&r=' + rno);
                                        }
                                    }
                                </script>
                                <?php
                                if (isset($_GET['i']) && isset($_GET['p']) && isset($_GET['r'])) {
                                    $j = $_GET['i'];
                                    $p = $_GET['p'];
                                    $r = $_GET['r'];
                                    echo $j;
                                    $sql = "UPDATE `tenants` SET `t` = '0' WHERE `tenants`.`id` = $j";
                                    $sql1 = "UPDATE `rooms` SET `status` = 'vacant' WHERE `rooms`.`plot_id` = '$p' AND `rooms`.`room_number` = '$r'";

                                    $res = mysqli_query($conn, $sql);
                                    if ($res == true) {
                                        $res1 = mysqli_query($conn, $sql1);
                                        if ($res1 == true) {
                                            echo '<script> alert ("Tenant cleared Successfully and Room declared vacant!!");</script>';
                                            echo '<script> window.location.href=\'view_tenants.php\';</script>';
                                        } else {
                                            echo 'WRONG SQL';
                                            echo "very wrong", mysqli_error($conn);
                                        }
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

