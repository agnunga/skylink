<?php
require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 

require_once './header.php';

if (isset($_POST['details']) || isset($_GET['id'])) {
    $pid = 0;
    if (isset($_POST['details'])) {
        $pid = $_POST['plot_id'];
    }
    if (isset($_GET['id'])) {
        $pid = $_GET['id'];
    }
    ?>
    <!--  page-wrapper -->
    <div id="page-wrapper">


        <div class="row">
            <!--  page header -->
            <div class="col-lg-12">
                <h1 class="page-header">The List of Rooms in Plot No: <?php echo $pid; ?></h1>
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
                            <?php
                            $sql0 = "SELECT * FROM `plots` WHERE plot_id = '$pid'";
                            $sql = "SELECT "
                                    . " p.plot_id, p.estate, p.lid,"
                                    . " r.id, r.plot_id, r.room_number, r.status, r.room_type, r.deposit, r.rent"
                                    . " FROM plots p, rooms r"
                                    . " WHERE p.plot_id = '$pid'"
                                    . " AND r.plot_id = '$pid'";


                            $res = mysqli_query($conn, $sql);
                            $res0 = mysqli_query($conn, $sql0);
                            $i = 0;
                            if ($res0 == true) {
                                ?>
                                <div>
                                    <?php
                                    foreach ($res0 as $row) {
                                        echo "Details of Plot NO: " . $row['plot_id'] . ", ";
                                        echo $row['estate'] . " estate, Owned by: ";
                                        echo $row['lid'];
                                    }
                                    ?>
                                </div>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Room No</th>
                                            <th>Type</th>
                                            <th>Deposit</th>
                                            <th>Rent</th>
                                            <th>Status</th>
                                            <!--<th>Action</th>-->
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
                                                <td>
                                                    <input type="hidden" name="id[]" value="<?php echo $row["id"] ?>">

                                                    <label>
                                                        <?php echo $row["room_type"] ?>
                                                    </label>
                                                    <select  name="type[]" style="margin: 0; padding: 0;">
                                                        <option value="<?php echo $row["room_type"] ?>">--Change--</option> 
                                                        <option value="single">Single</option>
                                                        <option value="single Self">Single Self</option>
                                                        <option value="double">Double</option>
                                                        <option value="double_self">Double Self</option>
                                                        <option value="self_contained">Self Contained</option>
                                                        <option value="one_bedroom">One Bedroom</option>
                                                        <option valus="two_bedroom">Two Bedroom</option>
                                                        <option value="three_bedroom">Three Bedroom</option>
                                                        <option value="three_bedroom">commercial</option>
                                                        <option>others</option>
                                                    </select>


                                                </td>
                                        <style>
                                            .unset_form_me{
                                                margin: 0; width: 100%; height: 40px; border-radius: 0; border: 1px solid black; text-align: right; background: transparent;
                                            }
                                        </style>
                                        <td style="padding: 0 10px; vertical-align: central;">
                                            <input name="deposit[]" value="<?php echo $row["deposit"] ?>" placeholder="deposit" class="unset_form_me">
                                        </td>
                                        <td style="padding: 0 10px;"><input name="rent[]" value="<?php echo $row["rent"] ?>" placeholder="Rent"  class="unset_form_me"></td>
                                        <td><?php echo $row["status"] ?></td>
            <!--                                                    <td>
                                            <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button>
                                            button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button
                                            <a href="view_property.php?i=<?php echo $row['id']; ?>&&rmpz=gtgbshdsy6ujsjhsbfjh8uhhasgdhagv" class='delete_icon'> DELETE</a>

                                            <form method="post" action="view_property_details.php">
                                                <input type="submit" value="Details" name="details" class="btn btn-xs btn-primary">
                                            </form>
                                        </td>-->
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

