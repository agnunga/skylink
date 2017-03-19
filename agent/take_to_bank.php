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
                <h1 class="page-header" style="text-align: center;"> Record of Amount Banked</h1>
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
                                if (isset($_POST['bank_it'])) {
                                    $bank = $_POST['bank'];
                                    $acnt = $_POST['account_no'];
                                    $amount = $_POST['amount'];
                                    $tid = $_POST['tid'];
                                    $added_by = $_SESSION['login_user1'];

                                    $sql = "INSERT INTO `to_bank` "
                                            . "(`bank`, `account_no`, `amount`, `tid`, `date_added`, `added_by`)"
                                            . " VALUES ('$bank', '$acnt', '$amount', '$tid', CURRENT_TIMESTAMP, '$added_by')";
                                    $res = mysqli_query($conn, $sql);

                                    if ($res === false) {
                                        echo "very wrong", mysqli_error($conn);
                                    } else {
                                        ?>
                                        <script type="text/javascript">
                                            alert("Amount Banked Recorded!");
                                        </script>

                                        <?php
                                    }
                                }
                                ?>
                                <form class="col-sm-offset-2 col-sm-5" role="form" method="post" action="">
                                    <h2>Record Banked Amount</h2>  
                                    <div class="form-group">
                                        <label>Bank name</label>
                                        <select  name="bank" class="form-control" required="" >
                                            <option value="equity">Equity</option>
                                            <option value="kcb">KENYA COMMERCIAL BANK</option>
                                            <option value="coop">COOPERATIVE BANK</option>
                                            <option value="barclays">BARCLAYS BANK</option>
                                            <option value="family">FAMILY BANK</option>
                                            <option value="cfc stanbic">CFC STANBIC BANK</option>
                                            <option value="faulu">FAULU BANK</option>
                                            <option value="sidian">SIDIAN BANK</option>
                                            <option value="cba">COMMERCIAL BANK OF AFRICA</option>
                                            <option value="national">NATONAL BANK</option> 
                                            <option value="chase">CHASE BANK</option>
                                            <option value="transnational">TRANSNATIONAL BANK</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>&nbsp;&nbsp;&nbsp;Account number</label>
                                        <input  name="account_no" class="form-control" placeholder="Account number"required=""> 
                                    </div> 
                                    <div  class="form-group">
                                        <label>&nbsp;&nbsp;&nbsp;Amount banked</label>
                                        <input class="form-control" name="amount" placeholder="Amount"required="">
                                    </div> 
                                    <div  class="form-group">
                                        <label>&nbsp;&nbsp;&nbsp;Transaction number</label>
                                        <input class="form-control" name="tid" placeholder="Transaction Number" minlength="8" maxlength="30"required="">
                                    </div> 
                                    <button type="submit" name="bank_it" class="btn btn-primary btn-lg btn-block">Record Money Banked </button>
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


