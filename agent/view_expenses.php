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
            <h1 class="page-header">The List of Expenses</h1>
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
                        $sql = "SELECT * FROM `expenses` ORDER BY `id` DESC";
                        $res = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($res == true) {
                            ?>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Plot ID</th>
                                        <th>title</th>
                                        <th>Amount</th>
                                        <th>Date incurred</th>
                                        <th>Added by</th>
                                        <!--<th>State</th>-->
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
                                            <td><?php echo $row["plot_id"] ?></td>
                                            <td><?php echo $row["title"] ?></td>
                                            <td><?php echo $row["amount"] ?></td>
                                            <td><?php echo $row["exp_date"] ?></td>
                                            <td><?php echo $row["added_by"] ?></td>
                                            <!--<td>
                                            <?php // echo $row["state"]                   
                                            ?>
                                            </td>-->
        <!--                                                <td>
                                                <button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button>
                                                button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button
                                                <a href="view_property.php?i=<?php echo $row['id']; ?>&&rmpz=gtgbshdsy6ujsjhsbfjh8uhhasgdhagv" class='delete_icon'> DELETE</a>

                                                <form method="post" action="view_property_details.php">
                                                    <input type="hidden" value="<?php echo $row["plot_id"] ?>" name="plot_id" readonly="">
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
                            echo '<script type="text/javascript"> alert ("Account successfully Created!!!");' . ' ' .
                            '';
                            echo "very wrong";
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


