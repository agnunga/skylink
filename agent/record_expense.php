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
                <h1 class="page-header" style="text-align: center;"> Record an Expense or Voucher</h1>
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
                            <div class="col-lg-10">
                                <?php
                                if (isset($_POST['submit'])) {
                                    $plot_id = $_POST['plot_id'];
                                    $title = $_POST['title'];
                                    $amount = $_POST['amount'];
                                    $added_by = $_SESSION['login_user1'];


                                    $sql = "INSERT INTO `expenses` "
                                            . "(`plot_id`, `title`, `amount`, `date_added`, `added_by`)"
                                            . " VALUES ('$plot_id', '$title', '$amount', CURRENT_TIMESTAMP, '$added_by')";
                                    $res = mysqli_query($conn, $sql);

                                    if ($res === false) {


                                        echo "very wrong", mysqli_error($conn);
                                    } else {
                                        ?>
                                        <script type="text/javascript">
                                            alert("Expenditure submitted successfully!!!")
                                        </script>

                                        <?php
                                    }
                                }

                                if (isset($_POST['record_voucher'])) {
                                    $title = $_POST['title'];
                                    $amount = $_POST['amount'];
                                    $added_by = $_SESSION['login_user1'];


                                    $sql = "INSERT INTO `vouchers` "
                                            . "(`title`, `amount`, `date_added`, `added_by`)"
                                            . " VALUES ('$title', '$amount', CURRENT_TIMESTAMP, '$added_by')";
                                    $res = mysqli_query($conn, $sql);

                                    if ($res === false) {
                                        echo "very wrong", mysqli_error($conn);
                                    } else {
                                        ?>
                                        <script type="text/javascript">
                                            alert("Voucher entry success!");
                                        </script>

                                        <?php
                                    }
                                }
                                ?>
                                <form class="col-sm-5" role="form" method="post" action="">
                                    <h2>Record Expenditure</h2> 
                                    <div class="form-group">
                                        <label>Plot ID</label>
                                        <input name="plot_id" class="form-control" placeholder="Plot ID" required="" maxlength="8">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>&nbsp;&nbsp;&nbsp;Expense</label>
                                            <select  name="title" class="form-control" length="70%"required="" style="text-align: center;">
                                                <option value="">---select---</option>
                                                <option value="kra">KRA</option>
                                                <option value="sacco">SACCO</option>
                                                <option value="advance">ADVANCE</option>
                                                <option value="insurance">INSURANCE</option>
                                                <option value="caretaker">CARETAKER</option>
                                                <option value="electricity">ELECTRICITY BILL</option>
                                                <option value="water"> WATER BILL</option>
                                                <option value="painting">PAINTING</option>
                                                <option value="repairs">REPAIRS AND MAINTENANCE</option>
                                                <option value="electrical_repairs">ELECTRICAL REPAIRS</option>
                                            </select>
                                        </div>


                                        <div  class="form-group col-sm-6">
                                            <label>&nbsp;&nbsp;&nbsp;Amount</label>
                                            <input class="form-control" name="amount" placeholder="AMOUNT PAID" required="" maxlength="7"style="text-align: right;">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Record Expenditure</button>
                                </form>

                                <form class="col-sm-offset-2 col-sm-5" role="form" method="post" action="">
                                    <h2>Record Voucher</h2> 
                                    <div class="form-group">
                                        <label>&nbsp;&nbsp;&nbsp;Voucher name</label>
                                        <input  name="title" class="form-control"required=""> 
                                    </div>
                                    <div  class="form-group">
                                        <label>&nbsp;&nbsp;&nbsp;Amount</label>
                                        <input class="form-control" name="amount" placeholder="Amount"required="" maxlength="7"style="text-align: right;">
                                    </div> 
                                    <button type="submit" name="record_voucher" class="btn btn-warning btn-lg btn-block">Record Voucher</button>
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

<script>

    //datepicker
    $(function () {
    $("#date1").datepicker({
    dateFormat: "yy-mm-dd",
            defaultDate: + 1,
            showAnim: "slide",
            minDate: "+1d",
            maxDate: "+1y"
    });
</script>
<?php
require_once './footer.php';


