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
            <h1 class="page-header">The List of Vacant Houses</h1>
        </div>
        <!-- end  page header -->
    </div>
    <div class="row">
        <?php
        if (isset($_POST['update'])) {

            $id = $_POST['id'];
            $type = $_POST['type'];
            $deposit = $_POST['deposit'];
            $rent = $_POST['rent'];

            $x = 0;
            foreach ($id as $i) {
                $sql = "UPDATE `rooms` SET `room_type` = '$type[$x]',  `deposit` = '$deposit[$x]', `rent` = '$rent[$x]' WHERE `rooms`.`id` = $id[$x]";
                $res = mysqli_query($conn, $sql);
                $i = 0;
                if ($res == true) {
                    ?>
                                    <!--                        <script type="text/javascript">
                                                            alert("Updated successfully!!!")
                                                        </script>-->
                    <?php
                } else {
                    echo mysqli_error($conn);
                }
//                    echo '<br/>';
                $x++;
            }
        }
        ?>
        <div class="col-lg-12">
            <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="" style="text-align: right;">
                    <a href="view_occupied.php">View occupied rooms </a>

                </div>
                <div class="panel-heading">
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql = "SELECT r.room_number, r.plot_id, r.status, r.room_type, r.deposit, r.rent, p.lid, p.plot_id, p.estate"
                                . " FROM rooms r, plots p "
                                . "WHERE r.status='vacant' AND r.plot_id = p.plot_id ORDER BY r.id ASC ";
                        $res = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($res == true) {
                            ?>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Plot Code</th>
                                        <th>RoomNo</th>
                                        <th>Estate</th>
                                        <th>Deposit</th>
                                        <th>Rent</th>
                                        <th>Owner</th>
                                        <th>Room type</th>
                                        <!--<th>State</th>-->
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
                                            <td><?php echo $row["plot_id"] ?></td>
                                            <td><?php echo $row["room_number"] ?></td>
                                            <td><?php echo $row["estate"] ?></td>
                                            <td><?php echo $row["deposit"] ?></td>
                                            <td><?php echo $row["rent"] ?></td>
                                            <td><?php echo $row["lid"] ?></td>
                                            <td><?php echo $row["room_type"] ?></td>
                                            <!--<td><?php // echo $row["status"]  ?></td>-->
                                            <td>
                                                <!--<button class="btn btn-primary btn-sm"><i class="fa fa-edit "></i> Edit</button>-->
                                                <!--button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button-->
                                                <a href="add_tenant.php?pn=<?php echo $row['plot_id'] . '&rn=' . $row['room_number']; ?>&msc=qvbggh4bjh4bnjhgbn" class='btn btn-sm btn-success'> Allocate</a></td>
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


