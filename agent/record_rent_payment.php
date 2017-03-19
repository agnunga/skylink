<?php
require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 

require_once './header.php';

$sql1 = "INSERT INTO "
        . " `other_payments` (`id`, `plot_id`, `house_id`, `tenant_id`, `paid_for`, `amount_paid`, `added_by`, `date_added`, `modified_by`, `date_modified`)"
        . " VALUES ('', '', '', '', '', '', '', CURRENT_TIMESTAMP, '', CURRENT_TIMESTAMP)";
?> 
<!--  page-wrapper -->
<div id="page-wrapper">



    <div class="row" id="the_to_pdf">
        <div class="row">
            <!-- page header -->
            <div class="col-lg-12">
                <h1 class="page-header" style="text-align: center;">Record Received Rent And Other Payments</h1>
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
                            <div class="col-md-5">
                                <?php
                                if (isset($_POST['submit'])) {
                                    $natid = $_POST['natid'];
                                    $amount = $_POST['amount'];
                                    $rent_due = $_POST['rent_due'];
                                    $month = $_POST['month'] . '/' . $_POST['year'];
                                    $added_by = $_SESSION['login_user1'];


                                    $sql = "INSERT INTO `rent` "
                                            . "(`natid`, `rent_amount`, `rent_due`, `month_paid_for`, `added_by`)"
                                            . " VALUES ('$natid', '$amount', '$rent_due', '$month', '$added_by')";
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
                                ?>
                                <form role="form" method="post" action="">
                                    <h1>Rent Payment</h1>
                                    <div class="form-group">
                                        <label>Tenant National ID</label>
                                        <input name="natid" class="form-control" placeholder="ID" required="">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>Mode of payment</label>
                                            <select  name="mop" class="form-control" id="mode_of_payment" required="" style="text-align: center;">
                                                <option value="">-select payment mode-</option>
                                                <option value="cash">Cash</option>
                                                <option value="cheque">Cheque</option>
                                                <option value="lnmpesa">Lipa na Mpesa</option>
                                                <option value="eazzypay">Eazzy Pay</option>
                                                <option value="bank_deposit">Bank Deposit</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Rent for:</label>
                                            <div>
                                                <select name="month"  class="input-sm" required="" style="text-align: center;">
                                                    <option value="0">Month</option>

                                                    <?php
                                                    for ($i = 1; $i <= 12; $i++) {
                                                        echo "<option value='$i'>$i</option>";
                                                    }
                                                    ?>
                                                </select> 
                                                <select name="year"  class=" input-sm" required="" style="text-align: center;">
                                                    <option value="<?php echo date('Y'); ?>">This Year</option>

                                                    <?php
                                                    $y = date('Y') - 2;
                                                    for ($i = $y; $i <= $y + 4; $i++) {
                                                        echo "<option>$i</option>";
                                                    }
                                                    ?>
                                                </select> 
                                            </div>
                                        </div>

                                        <script>
                                            $(document).ready(function () {
                                                //
                                                $('#txn_details').hide();
                                                $('#mode_of_payment').change(function () {
                                                    $('#txn_details').show();
                                                    selected = $('#mode_of_payment').val();
                                                    //                                                        alert(selected);
                                                    if (selected != '') {
                                                        $('#txn_details').removeClass('hidden');
                                                        if (selected == 'cash') {
                                                            $('#txn_details').addClass('hidden');
                                                            $('#inlidf').val('cash');
                                                            $('#inltxn').val('cash');
                                                        } else if (selected == 'cheque') {

                                                            $('#lidf').empty().append('Bank Name');
                                                            $('#ltxn').empty().append('Cheque Number.');
                                                        } else if (selected == 'lnmpesa') {

                                                            $('#lidf').empty().append('Pnone No:');
                                                            $('#ltxn').empty().append('Transaction Identity.');
                                                        } else if (selected == 'eazzypay') {

                                                            $('#lidf').empty().append('Phone Number:');
                                                            $('#ltxn').empty().append('Transaction Number.');
                                                        } else if (selected == 'bank_deposit') {

                                                            $('#lidf').empty().append('Bank Name:');
                                                            $('#ltxn').empty().append('Transaction Number.');
                                                        }
                                                    } else {

                                                    }
                                                });
                                            });
                                        </script>
                                    </div>

                                    <div class="row hidden" id="txn_details">
                                        <div class="form-group col-sm-6">
                                            <label id="lidf"> </label>
                                            <input  id="inlidf" class="form-control" name="amount" placeholder="Transaction idenitifier" required="">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label id="ltxn"></label>
                                            <input id="inltxn" class="form-control" name="rent_due" placeholder="Transaction Identity">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>Rent Amount</label>
                                            <input style="text-align: right;" class="form-control" name="amount" placeholder="Amount paid" required="">
                                        </div>
                                        <div class="form-group col-sm-12 hidden">
                                            <label>Rent Due</label>
                                            <input class="form-control" name="rent_due" value="0" placeholder="Rent due">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">submit</button>

                                </form>
                            </div>

                            <div class="col-md-offset-1 col-md-4">
                                <form role="form" method="post" action="">
                                    <h1>Other Payments</h1>
                                    <div class="form-group">
                                        <label>Tenant National ID</label>
                                        <input name="natid" class="form-control input-sm" placeholder="ID" required="">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>Payment for:</label>
                                            <select  name="pf" class="form-control input-sm" required="" >
                                                <option value="">--select--</option>
                                                <option value="deposit">Rent Deposit</option>
                                                <option value="elect">Electricity Deposit</option>
                                                <option value="gabbage">Garbage Collection</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Amount Paid</label>
                                            <input style="text-align: right;" class="form-control input-sm" name="amount" placeholder="Amount paid" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <select  name="pf" class="form-control" required="" >
                                                <option value="">--select--</option>
                                                <option value="deposit">Rent Deposit</option>
                                                <option value="elect">Electricity Deposit</option>
                                                <option value="gabbage">Garbage Collection</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <input style="text-align: right;" class="form-control" name="amount" placeholder="Amount paid" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <select  name="pf" class="form-control input-sm" required="" >
                                                <option value="">--select--</option>
                                                <option value="deposit">Rent Deposit</option>
                                                <option value="elect">Electricity Deposit</option>
                                                <option value="gabbage">Garbage Collection</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <input style="text-align: right;" class="form-control input-sm" name="amount" placeholder="Amount paid" required="">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit_others" class="btn btn-primary btn-sm btn-block">Record Payment</button>

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
    <div id="option1" class="group">asdf</div>
    <div id="option2" class="group">kljh</div>
    <div id="option3" class="group">zxcv</div>
    <div id="option4" class="group">qwerty</div>
    <select id="selectMe">
        <option value="option1">option1</option>
        <option value="option2">option2</option>
        <option value="option3">option3</option>
        <option value="option4">option4</option>
    </select>

</div>

<?php
require_once './footer.php';


