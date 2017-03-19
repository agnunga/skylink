<?php
require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user1');

//Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']); 

require_once './header.php';

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lid = $_POST['lid'];
    $natid = $_POST['natid'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $bank = $_POST['bank'];
    $branch = $_POST['branch'];
    $acc_no = $_POST['acc_no'];
    $pay_day = $_POST['pay_day'];
    $added_by = $_SESSION['login_user1'];


    $sql = "INSERT INTO `landlords` "
            . "(`fname`, `lid`,  `natid`, `phone`, `address`,  `bank`,  `branch`, `acc_no`, `pay_day`, `added_by`)"
            . " VALUES ('$fname', '$lid', '$natid', '$phone', '$address', '$bank', '$branch', '$acc_no', '$pay_day', '$added_by')";

    $res = mysqli_query($conn, $sql);

    if ($res === false) {


        echo "very wrong", mysqli_error($conn);
    } else {
        ?>
        <script type="text/javascript">
            alert("Amount submitted successfully!!!");
            window.location = 'add_landlord.php?id=<?php echo '3'; ?>';
        </script>

        <?php
    }
}
?> 

<div id="page-wrapper">
    <div class="row">
        <div class="row">
            <!-- page header -->
            <div class="col-lg-12">
                <h1 class="page-header"> Create a New Landlord Account</h1>
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
                                <form role="form" method="post" action="">

                                    <div class="form-group">
                                        <label>FULL NAME</label>
                                        <input class="form-control" placeholder="Full name"name="fname" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Landlord ID</label>
                                        <input class="form-control" placeholder="Landlord ID" name="lid" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label>NATIONAL ID</label>
                                        <input class="form-control" placeholder="ID Number" name="natid" required="" minlength="6" maxlength="8" >
                                    </div>
                                    <div class="form-group">
                                        <label>PHONE NUMBER</label>
                                        <input class="form-control" placeholder="Phonrnumber" name="phone" required="" minlength="10" maxlength="13">
                                    </div>
                                    <div class="form-group">
                                        <label>PHYSICAL ADDRESS</label>
                                        <input class="form-control" placeholder="P.O BOX" name="address" required="" minlength="">
                                    </div>
                                    <div class="form-group">
                                        <label>BANK</label>
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
                                        <label>BRANCH</label>
                                        <input class="form-control" placeholder="Bank branch" name="branch" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label>ACCOUNT NUMBER</label>
                                        <input class="form-control" placeholder="Account Number" name="acc_no" required="">
                                    </div>

                                    <div class="form-group">
                                        <label>Date of payment</label>
                                        <input class="form-control" placeholder="Payment date" name="pay_day" required="">
                                    </div>


                                    <input  type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg btn-block" >

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


