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
        <div class="row">
            <!-- page header -->
            <div class="col-lg-12">
                <h1 class="page-header"> Receive Deposit</h1>
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
                                <?php
                                if (isset($_POST['submit'])) {
                                    $natid = $_POST['natid'];
                                    $amount = $_POST['amount'];
                                    $rent_due = $_POST['rent_due'];
                                    $month = $_POST['month'] . '/' . $_POST['year'];
                                    $added_by = $_SESSION['login_user1'];


                                    $sql = "INSERT INTO `deposit` "
                                            . "(`natid`, `rent_amount`, `rent_due`, `month_paid_for`, `added_by`)"
                                            . " VALUES ('$natid', '$plot_id', '$house_id', '$amount', '$rent_due', '$month', '$added_by')";
                                    $res = mysqli_query($conn, $sql);

                                    if ($res === false) {


                                        echo "very wrong", mysqli_error($conn);
                                    } else {
                                        ?>
                                        <script type="text/javascript">
                                            alert("Amount submitted successfully!!!")
                                            //                window.location = 'print_receipt.php?id=<?php echo '3'; ?>';
                                        </script>

                                        <?php
                                        $sql = "SELECT * FROM `deposit` WHERE natid='$natid' ORDER BY id DESC LIMIT 1";
                                        $res = mysqli_query($conn, $sql);

                                        if ($res === false) {
                                            echo "very wrong", mysqli_error($conn);
                                        } else {

                                            foreach ($res as $row) {
                                                ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!--                                                            <script type="text/javascript">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    if (confirm("Print Receipt?")) {

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </script>-->
                                                <?php
                                                //echo $row['natid'];
                                                //echo $row['plot_id'];
                                                //echo $row['room_number'];
                                                //echo $row['rent_amount'];
                                                //echo $row['rent_due'];
                                                //echo $row['month_paid_for'];
                                                //echo $row['time_paid'];
                                                ?>
                                                <form role="form" method="post" action="print_receipt.php">
                                                    <input type="hidden" class="form-control" name="natid" value="<?php echo $row['fname']; ?>" placeholder="ID">
                                                    <input type="hidden" class="form-control" name="natid" value="<?php echo $row['natid']; ?>" placeholder="ID">
                                                    <input  type="hidden" class="form-control" name="plot_id" value="<?php echo $row['plot_id']; ?>" placeholder="PLOT ID">
                                                    <input  type="hidden" class="form-control" name="house_id" value="<?php echo $row['room_number']; ?>" placeholder="HOUSE NUMBER">
                                                    <input type="hidden"  class="form-control" name="amount" value="<?php echo $row['rent_amount']; ?>" placeholder="AMOUNT PAID">
                                                    <input type="hidden"  class="form-control" name="rent_due" value="<?php echo $row['rent_due']; ?>" placeholder="rent due">
                                                    <input  type="hidden" class="form-control" name="month_paid_for" value="<?php echo $row['month_paid_for']; ?>" placeholder="Month paid for">
                                                    <input  type="hidden" class="form-control" name="time_paid" value="<?php echo $row['time_paid']; ?>" placeholder="Time paid">
                                                    <input  type="hidden" class="form-control" name="agent" value="<?php echo $_SESSION['login_user1']; ?>" placeholder="Time paid">
                                                    <button type="submit" name="print_receipt" class="btn btn-primary btn-lg btn-block">PRINT RECEIPT</button>
                                                </form>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                                <form role="form" method="post" action="">
                                    <div class="form-group">
                                        <label>Tenant National ID</label>
                                        <input name="natid" class="form-control" placeholder="ID">
                                    </div>
                                    <div class="form-group">
                                        <label>Rent for: </label>
                                        <select name="month" style="text-align: center;">
                                            <option value="0">Month</option>

                                            <?php
                                            for ($i = 1; $i <= 12; $i++) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select> 
                                        <select name="year" style="text-align: center;">
                                            <option value="<?php echo date('Y'); ?>">This Year</option>

                                            <?php
                                            $y = date('Y') - 2;
                                            for ($i = $y; $i <= $y + 4; $i++) {
                                                echo "<option>$i</option>";
                                            }
                                            ?>
                                        </select> 
                                    </div>
                                    <div class="form-group">
                                        <label>Rent Amount</label>
                                        <input class="form-control" name="amount" placeholder="AMOUNT PAID">
                                    </div>
                                    <div class="form-group">
                                        <label>Rent Due</label>
                                        <input class="form-control" name="rent_due" placeholder="RENT DUE(BALANCE)">
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">submit</button>

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


