<?php
require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 

require_once './header.php';

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $natid = $_POST['natid'];
    $nonok = $_POST['nonok'];
    $nokcontact = $_POST['nokcontact'];
    $phone = $_POST['phone'];
    $pow = $_POST['pow'];
    $plot_no = $_POST['plot_no'];
    $room_no = $_POST['room_no'];
    $rltn = $_POST['rltn'];
    $added_by = $_SESSION['login_user1'];


    $sql = "INSERT INTO "
            . "`tenants` (`fname`, `natid`, `phone`, `plot_id`, `room_number`, `added_by`, `created_at`,`nok_name`, `nok_phone`, `nok_rel`, `place_of_wrk`)"
            . " VALUES ('$fname', '$natid', '$phone', '$plot_no', '$room_no', '$added_by', CURRENT_TIMESTAMP, '$nonok', '$nokcontact', '$rltn', '$pow')";

    $sql1 = "UPDATE `rooms` SET `status` = '1' WHERE `rooms`.`room_number` = $room_no AND `rooms`.`plot_id` = '$plot_no'";

    $res1 = mysqli_query($conn, $sql1);

    $res = mysqli_query($conn, $sql);

    if ($res1 === false) {
        echo "very wrong", mysqli_error($conn);
    } else {
        ?>
        <script type="text/javascript">
            alert("Rooms updated");
        </script>
        <?php
    }

    if ($res === false) {


        echo "very wrong", mysqli_error($conn);
    } else {
        ?>
        <script type="text/javascript">
            alert("Room alocated successfully!!!");
            window.location = 'view_vacants.php';
        </script>

        <?php
    }
}
?>
<!--  page-wrapper -->
<div id="page-wrapper">



    <div class="row">
        <div class="row">
            <!-- page header -->
            <div class="col-lg-12">
                <h1 class="page-header"> Add A New Tenant</h1>
            </div>
            <!--end page header -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form role="form" method="POST" action="">
                                    <h2>   
                                        Allocate

                                        Room No: <?php
if (isset($_GET['rn'])) {
    echo $_GET['rn'];
}
?>
                                        , in Plot No: <?php
                                        if (isset($_GET['pn'])) {
                                            echo $_GET['pn'];
                                        }
?>
                                    </h2>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input name="fname" class="form-control" placeholder="Full Name" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>National ID</label>
                                        <input name="natid" class="form-control" placeholder="Nationsl ID" required="">
                                    </div>
                                    <!--
                                    
                                    -->
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input name="phone" class="form-control" placeholder="Phone Number" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Place of work</label>
                                        <input name="pow" class="form-control" placeholder="Place Of Work" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Name of next of kin</label>
                                        <input name="nonok" class="form-control" placeholder="Next of Kin" >
                                    </div>
                                    <div class="form-group">
                                        <label>Relationship</label>
                                        <input name="rltn" class="form-control" placeholder="Relationship">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact of next of kin</label>
                                        <input name="nokcontact" class="form-control" placeholder="Contact of next of kin">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <!--<label>Plot number</label>-->
                                        <input type="hidden" name="plot_no" class="form-control"
                                               value="<?php
                                        if (isset($_GET['pn'])) {
                                            echo $_GET['pn'];
                                        }
?>" readonly="">

                                    </div>

                                    <div class="form-group col-sm-6">
                                        <!--<label>Room number</label>-->
                                        <input type="hidden" name="room_no" class="form-control"
                                               value="<?php
                                               if (isset($_GET['rn'])) {
                                                   echo $_GET['rn'];
                                               }
?>" readonly="">

                                    </div>
                                    <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Form Elements -->
    </div>
</div> 
</div>

<?php
require_once './footer.php';


