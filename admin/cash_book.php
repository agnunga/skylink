<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php"); 
Session::confirm_logged_in('login_user');

    require_once './header.php';
    ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">
                        <span style="text-align: left;" class="col-sm-8">
                            Cash Book statement
                        </span>

                        <span style="text-align: right;" class="col-sm-4">
                            <?php
                            echo $d = (isset($_POST['l_cash_flow']) ? $_POST['day'] : date('d'));
                            echo '/';
                            echo $m = (isset($_POST['l_cash_flow']) ? $_POST['month'] : date('m'));
                            echo '/';
                            echo $y = (isset($_POST['l_cash_flow']) ? $_POST['year'] : date('Y'));
                            echo ' : ';
                            ?>                            
                        </span>

                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-69">
                    <!--    Striped Rows Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            <div class="form" style="text-align: right;">
                                <form class="form-inline" method="POST"> 

                                    <label>Day: </label>
                                    <select class="form-control input-sm" name="day">
                                        <option value="<?php echo $d; ?>"><?php echo $d; ?></option>

                                        <?php
                                        for ($i = 1; $i <= 31; $i++) {
                                            echo "<option value = '" . sprintf("%02s", $i) . "'>" . sprintf("%02s", $i) . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label>Month: </label>
                                    <select class="form-control input-sm" name="month">
                                        <option value="<?php echo $m; ?>"><?php echo $m; ?></option>

                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo "<option value = '" . sprintf("%02s", $i) . "'>" . sprintf("%02s", $i) . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label>Year: </label>
                                    <select class="form-control input-sm" name="year">
                                        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                                        <?php
                                        $j = date('Y');
                                        for ($i = ($j - 1); $i <= (date('Y') + 1); $i++) {
                                            echo "<option value = '$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                    <input class="btn btn-success btn-sm" type="submit" name="l_cash_flow" value="VIEW">
                                </form>

                            </div>

                            <h2>
                                Rent Received
                            </h2>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <?php
                                $today = $y . "-" . $m . "-" . $d;
                                $sql = "SELECT p.plot_id, p.lid, p.commission, t.fname, t.natid, t.plot_id, t.room_number, l.lid,"
                                        . " r.natid, r.rent_amount, r.rent_due, r.month_paid_for, r.time_paid, r.added_by"
                                        . " FROM rent r, plots p, landlords l, tenants t"
                                        . " WHERE t.natid = r.natid  AND r.t=1 AND t.plot_id=p.plot_id AND l.lid=p.lid AND  r.time_paid LIKE '%$today%'";

                                $res = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($res == true) {
                                    ?>

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-exampleXXX">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tenant Name</th>
                                                <th>Plot ID</th>
                                                <th>House ID</th>
                                                <th>Month Paid</th>
                                                <th>Payment date</th>
                                                <th>Received by</th>
                                                <th>Amount</th>
                                                <!--<th>State</th>-->
                                                <!--<th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;

                                            $exp = 0;
                                            $vou = 0;
                                            foreach ($res as $row) {

                                                $i++;
                                                $total += ($row["rent_amount"]);
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row["fname"] ?></td>
                                                    <td><?php echo $row["plot_id"] ?></td>
                                                    <td><?php echo $row["room_number"] ?></td>
                                                    <td><?php echo $row["month_paid_for"] ?></td>
                                                    <td><?php echo $row["time_paid"] ?></td>
                                                    <td><?php echo $row["added_by"] ?></td>
                                                    <td style="text-align: right;"><?php echo $row["rent_amount"] ?> /=</td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="7" style="text-align: center;">Total Rent Received :</td>
                                                <th style="text-align: right;"><?php echo $total; ?> /=</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                } else {
                                    echo mysqli_error($conn);
                                }
                                ?> 

                            </div>

                        </div>

                    </div> 

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>
                                Expenses
                            </h2>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <?php
//                                echo $today = $y . "-" . $m . "-" . $d;

                                $sql = "SELECT e.plot_id,  e.title, e.amount, e.date_added, e.added_by"
                                        . " FROM expenses e"
                                        . " WHERE e.date_added LIKE '%$today%'";
                                $res = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($res == true) {
                                    ?>

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-exampleXXX">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Plot ID</th>
                                                <th>title</th>
                                                <th>Date incurred</th>
                                                <th>Added by</th>
                                                <th>Amount</th>
                                                <!--<th>State</th>-->
                                                <!--<th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($res as $row) {

                                                $i++;
                                                $exp += $row["amount"];
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row["plot_id"] ?></td>
                                                    <td><?php echo $row["title"] ?></td>
                                                    <td><?php echo $row["date_added"] ?></td>
                                                    <td><?php echo $row["added_by"] ?></td>
                                                    <td style="text-align: right;"><?php echo $row["amount"] ?> /=</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5" style="text-align: center;">Total Expenses:</td>
                                                <th style="text-align: right;"><?php echo $exp; ?> /=</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                } else {
                                    echo mysqli_error($conn);
                                }
                                ?> 

                            </div>

                        </div>

                    </div> 


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>
                                Vouchers 
                            </h2>          
                        </div>

                        <div class="table-responsive">

                            <?php
                            $sql = "SELECT * FROM `vouchers` WHERE date_added LIKE '$today%' ORDER BY `id` DESC";
                            $res = mysqli_query($conn, $sql);
                            $i = 0;
                            if ($res == true) {
                                ?>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-exampleXXX">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Date incurred</th>
                                            <th>Added by</th>
                                            <!--<th>State</th>-->
                                            <th>Amount</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($res as $row) {
                                            $vou +=$row["amount"];
                                            $i++;
                                            ?>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["title"] ?></td>
                                                <td><?php echo $row["date_added"] ?></td>
                                                <td><?php echo $row["added_by"] ?></td>
                                                <td style="text-align: right;"><?php echo $row["amount"] ?> /=</td>
                                            </tr>
                                        <?php }
                                        ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center;">Total Vouchers:</td>
                                            <th style="text-align: right;"><?php echo $vou; ?> /=</th>
                                        </tr>

                                        <?php
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
                                echo "very wrong";
                            }
                            ?> 

                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>
                                Money Banked 
                            </h2>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $sql = "SELECT * FROM `to_bank` WHERE `date_added` LIKE '$today%' AND t=1 ORDER BY `id` DESC";
                            $res = mysqli_query($conn, $sql);
                            $i = 0;
                            if ($res == true) {
                                ?>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-exampleXXX">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bank</th>
                                            <th>AccountNo:</th>
                                            <th>Transaction ID</th>
                                            <th>Date</th>
                                            <th>Banked by</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $banked = 0;

                                        foreach ($res as $row) {
                                            $banked += ($row["amount"]);
                                            $i++;
                                            ?>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["bank"] ?></td>
                                                <td><?php echo $row["account_no"] ?></td>
                                                <td><?php echo $row["tid"] ?></td>
                                                <td><?php echo $row["date_added"] ?></td>
                                                <td><?php echo $row["added_by"] ?></td>
                                                <td style="text-align: right;"><?php echo $row["amount"] ?> /=</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center;">Total Amount Banked :</td>
                                            <th style="text-align: right;"><?php echo $banked; ?> /=</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                echo "very wrong", mysql_error($conn);
                            }
                            ?> 
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <h2>
                            Total Balance : <?php echo ($total - $exp - $vou - $banked) ?> /=
                        </h2>
                        Prepared By: The System.
                    </div>

                    <!--  End  Striped Rows Table  -->
                </div>

            </div>



        </div>
    </div>	
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php
    require_once './footer.php';

    