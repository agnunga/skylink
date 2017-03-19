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
                <h1 class="page-header"> M-PESA Transaction

                </h1>
            </div>
            <!--end page header -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-lg-6">
                            <h2>
                                Record M-PESA Transaction
                            </h2> 
                        </div>
                        <div class="col-lg-offset-1 col-lg-5">
                            <h2>


                                <a href="mpesa_cashbook.php" style="text-decoration: none;">
                                    <div> 
                                        <div class="alert alert-success text-center">
                                            <b>View M-PESA CashBook</b> 
                                        </div> 
                                    </div>
                                </a>	

                            </h2> 
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php
                                if (isset($_POST['submit'])) {
                                    $natid = $_POST['natid'];
                                    $amount = $_POST['amount'];
                                    $identifier = $_POST['phone'];
                                    $txn_id = $_POST['txn_id'];
                                    $month = $_POST['month'] . '/' . $_POST['year'];
                                    $added_by = $_SESSION['login_user1'];

                                    $sql0 = "SELECT natid FROM `tenants` WHERE natid='$natid' AND t=1 LIMIT 1";
                                    $res0 = mysqli_query($conn, $sql0);
                                    if ($res0 === false) {
                                        echo "very wrong", mysqli_error($conn);
                                    } else {
                                        if (mysqli_num_rows($res0) == 0) {
                                            ?>
                                            <div class="alert alert-danger text-center">
                                                <i class="fa fa-info-circle fa-3x"></i>&nbsp;
                                                <p>The Tenant does not exist! Verify the ID Number and try again</p> 
                                            </div> 
                                            <?php
                                        } else {
//                                                echo 'Tenant exists.';

                                            $sql = "INSERT INTO `rent` "
                                                    . "(`natid`, `rent_amount`, `mop`, `identifier`, `txn_id`, `month_paid_for`, `added_by`)"
                                                    . " VALUES ('$natid', '$amount', 'mpesa', '$identifier','$txn_id', '$month', '$added_by')";
                                            $res = mysqli_query($conn, $sql);

                                            if ($res === false) {


                                                echo "very wrong", mysqli_error($conn);
                                            } else {
                                                ?>
                                                <script type="text/javascript">
                                                    alert("Amount submitted successfully!!!")
                                                </script>

                                                <?php
                                                $sql = "SELECT t.fname, t.natid, t.plot_id, t.room_number, "
                                                        . " r.natid, r.rent_amount, r.rent_due, r.month_paid_for, r.time_paid, r.added_by "
                                                        . " FROM rent r, tenants t "
                                                        . "WHERE t.natid=r.natid AND r.natid='$natid' ORDER BY r.id DESC LIMIT 1";
                                                $res = mysqli_query($conn, $sql);

                                                if ($res === false) {
                                                    echo "very wrong", mysqli_error($conn);
                                                } else {

                                                    foreach ($res as $row) {
                                                        ?>
                                                        <form role="form" method="post" action="print_receipt.php">
                                                            <input type="hidden" class="form-control" name="fname" value="<?php echo $row['fname']; ?>" placeholder="Full name">
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
                                    }
                                }
                                ?>
                                <form role="form" method="post" action="">
                                    <div class="form-group">
                                        <label>Tenant National ID</label>
                                        <input name="natid" class="form-control" placeholder="ID Number" required="">
                                    </div>

                                    <div class="row" id="">
                                        <div class="form-group col-sm-6">
                                            <label>Rent for: </label><br/>
                                            Month: <select name="month" style="text-align: center;">
                                                <option value="<?php echo date('m') ?>"><?php echo date('m') ?></option>

                                                <?php
                                                for ($i = 1; $i <= 12; $i++) {
                                                    echo "<option value = '" . sprintf("%02s", $i) . "'>" . sprintf("%02s", $i) . "</option>";
                                                }
                                                ?>
                                            </select> 
                                            &nbsp;&nbsp;Year: <select name="year" style="text-align: center;">
                                                <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>

                                                <?php
                                                $y = date('Y') - 2;
                                                for ($i = $y; $i <= $y + 4; $i++) {
                                                    echo "<option>$i</option>";
                                                }
                                                ?>
                                            </select> 
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label>Rent Amount</label>
                                            <input class="form-control" name="amount" placeholder="Amount Paid" required="">
                                        </div>
                                    </div>

                                    <div class="row" id="txn_details">
                                        <div class="form-group col-sm-6">
                                            <label id="lidf">Phone Number</label>
                                            <input  id="inlidf" class="form-control" name="phone" placeholder="Phone Number" required="">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label id="ltxn">Transaction ID</label>
                                            <input id="inltxn" class="form-control" name="txn_id" placeholder="Transaction Identity">
                                        </div>
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


