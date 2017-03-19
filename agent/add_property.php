<?php
require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 

require_once './header.php';

if (isset($_POST['submit'])) {
    $plot_id = $_POST['plot_id'];
    $estate = $_POST['estate'];
    $roomnumber = $_POST['roomnumber'];
    $lid = $_POST['lid'];
    $commission = $_POST['commission'];
    $added_by = $_SESSION['login_user1'];
//    $state = $_POST['state'];
//        echo "<br/>" . $plot_id . "<br/>" .
//        $estate . "<br/>" .
//        $roomnumber . "<br/>" .
//        $lid . "<br/>" .
    $sql = "INSERT INTO `plots` "
            . "( `plot_id`, `estate`, `room_no`,`lid`, `commission`, `added_by`)"
            . " VALUES ('$plot_id', '$estate', '$roomnumber', '$lid', '$commission','$added_by')";

    $res = mysqli_query($conn, $sql);

    if ($res === false) {
//            echo "very wrong", mysqli_error($conn);
        ?>
        <script type="text/javascript">
            alert("1   !!!<?php echo mysqli_error($conn); ?>");
        </script>
        <?php
    } else {
        for ($i = 1; $i <= $roomnumber; $i++) {
            $sql1 = "INSERT INTO "
                    . "`rooms` (`room_number`, `plot_id`, `status`, `room_type`, `rent`) "
                    . "VALUES ('$i', '$plot_id', 'vacant', '', '')";

            $res = mysqli_query($conn, $sql1);

            if ($res === false) {
                echo ' ' . $i;

//                    echo "X2X wrong ", mysqli_error($conn);
                ?>
                <script type="text/javascript">
                    alert("2  !!!<?php echo mysqli_error($conn); ?>");

                </script>

                <?php
            } else {
//                    echo "Ok. ALL ROOMS Added " . $i;
            }
        }
        ?>
        <script type="text/javascript">
            alert("PROPERTY successfully ADDED!!!");
            window.location = 'view_property_details.php?id=<?php echo $plot_id; ?>&olo=hbmjhgfvnmgfmnhvmnn';
        </script>

        <?php
    }
}
?>﻿
<!--  page-wrapper -->
<div id="page-wrapper">



    <div class="row">
        <div class="row">
            <!-- page header -->
            <div class="col-lg-12">
                <h1 class="page-header"> Add A New Property</h1>
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

                                <form id="form2" class="form-horizontal" action="" name="form1" method="post" role="form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-5">PLOT CODE</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" placeholder="Plot Code" name="plot_id" id="plot_id" required="required">

                                        </div>
                                    </div>
                                    <div class="form-group" required="">
                                        <label class="control-label col-sm-5">ESTATE</label>
                                        <div class="col-sm-7">

                                            <select  name="estate" class="form-control">
                                                <option value="guestinn">GUEST INN</option>
                                                <option value="hopewell">HOPEWELL</option>
                                                <option value="industrial">INDUSTRIAL AREA</option>
                                                <option value="kabati">KABATI</option>
                                                <option value="kanjo">KANJO</option>
                                                <option value="karagita">KARAGITA</option>
                                                <option value="kayole">KAYOLE</option>
                                                <option value="kinamba">KINAMBA</option>
                                                <option value="kihoto">KIHOTO</option>
                                                <option value="lakeview">LAKEVIEW</option>
                                                <option value="site">SITE</option>
                                                <option value="suberiko">SUBERIKO</option>
                                                <option value="town">TOWN</option>
                                                <option value="villaview">VILLA VIEW</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-5">Total Houses</label>
                                        <div class="col-sm-7">

                                            <input type="int" class="form-control" placeholder="No of Rooms" name="roomnumber" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-5">Landlord ID</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" placeholder="Landord ID" name="lid" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-5">Commission</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" placeholder="Percentage commission" name="commission" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="submit"  name="submit">submit</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
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


