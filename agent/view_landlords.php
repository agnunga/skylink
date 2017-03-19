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
            <h1 class="page-header">List of Landlords</h1>
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
                        $sql = "SELECT * FROM `landlords` ORDER BY `id` DESC";
                        $res = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($res == true) {
                            ?>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>CODE</th>
                                        <th>ID No</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Bank</th>
                                        <th>Branch</th>
                                        <th>Account no</th>
                                        <th>Payment day</th>
                                        <th>Added By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($res as $row) {

                                        $i++;
                                        ?>

                                        <tr>
                                            <!-- `acc_no`, `pay_day`, `added_by`-->
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row["fname"] ?></td>
                                            <td><?php echo $row["lid"] ?></td>
                                            <td><?php echo $row["natid"] ?></td>
                                            <td><?php echo $row["phone"] ?></td>
                                            <td><?php echo $row["address"] ?></td>
                                            <td><?php echo $row["bank"] ?></td>
                                            <td><?php echo $row["branch"] ?></td>
                                            <td><?php echo $row["acc_no"] ?></td>
                                            <td><?php echo $row["pay_day"] ?><sup>th</sup></td>
                                            <td><?php echo $row["added_by"] ?></td>

                                            <td>

                                                <form method="post" action="view_landlords_details.php">
                                                    <input type="hidden" value="<?php echo $row["lid"] ?>" name="lid" readonly="">
                                                    <input type="submit" value="Details" name="details" class="btn btn-sm btn-primary">
                                                </form>                         
                                            </td>
                                        </tr>
                                        <?php
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
        </div>
        <!--End Advanced Tables -->
    </div>
</div>

<?php
require_once './footer.php';


