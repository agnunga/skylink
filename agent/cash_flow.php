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

            <h1 class="page-header">
                Landlord Cash Flow Statement
            </h1>
        </div>
        <!-- end  page header -->
    </div> 
    <div class="row">


        <div class="col-md-12">
            <!--    Striped Rows Table  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 style="text-align: center;">

                        <?php
                        $l = (isset($_POST['l_cash_flow']) ? $_POST['lid'] : 'L1');
                        $lname = "";
                        echo $m = (isset($_POST['l_cash_flow']) ? $_POST['month'] : date('m'));
                        echo '/';
                        echo $y = (isset($_POST['l_cash_flow']) ? $_POST['year'] : date('Y'));
                        echo ' : ';

                        $sql = "SELECT p.plot_id, p.lid, l.fname, l.lid"
                                . " FROM plots p, landlords l"
                                . " WHERE p.lid=l.lid AND p.lid='$l' LIMIT 1";

                        $res = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($res == true) {
                            foreach ($res as $row) {
                                echo $lname = $row["fname"];
                                echo ' - ' . $row["lid"];
                            }
                        } else {
                            echo mysqli_error($conn);
                        }
                        ?>

                    </h2>
                </div>
                <div class="panel-body">
                    <div class="form" style="text-align: right;">
                        <form class="form-inline" method="POST">
                            <label>Landlord: </label>
                            <!--<input class="form-control input-sm" type="text" name="lid" value="L1" size="4">-->
                            <?php
                            $sql = "SELECT  lid, fname FROM landlords";

                            $res = mysqli_query($conn, $sql);
                            echo '<select class="form-control input-sm" name="lid">';
                            echo '<option value="' . $l . '">' . $l . ' - ' . $lname . '</option>';

                            if ($res == true) {
                                foreach ($res as $row) {
                                    echo '<option value="' . $row['lid'] . '">' . $row['lid'] . ' - ' . $row["fname"] . '</option>';
                                }
                            }
                            echo '</select>';
                            ?>

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
                    <div class="table-responsive">

                        <?php
                        echo $ym = $y . '-' . sprintf("%02s", $m);

                        $sql = "SELECT p.plot_id, p.lid, p.commission, t.fname, t.natid, t.plot_id, t.room_number, l.lid,"
                                . " r.natid, r.rent_amount, r.rent_due, r.month_paid_for, r.time_paid, r.added_by"
                                . " FROM rent r, plots p, landlords l, tenants t"
                                . " WHERE t.natid = r.natid  AND r.t=1 AND t.plot_id=p.plot_id AND l.lid=p.lid  AND p.lid='$l' AND  r.time_paid LIKE '$ym%'";

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
                                        <th>Rent Due</th>
                                        <th>Amount</th>
                                        <th>Commission</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    $comm = 0;
                                    $bal = 0;

                                    $exp = 0;
                                    foreach ($res as $row) {

                                        $i++;
                                        $total += ($row["rent_amount"]);
                                        $comm += ($row["commission"] * ($row["rent_amount"]) / 100);
                                        $bal += ((100 - $row["commission"]) / 100 * ($row["rent_amount"]));
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row["fname"] ?></td>
                                            <td><?php echo $row["plot_id"] ?></td>
                                            <td><?php echo $row["room_number"] ?></td>
                                            <td><?php echo $row["month_paid_for"] ?></td>
                                            <td><?php echo $row["time_paid"] ?></td>
                                            <td><?php echo $row["added_by"] ?></td>
                                            <td style="text-align: right;"><?php echo $row["rent_due"] ?> /=</td>
                                            <td style="text-align: right;"><?php echo $row["rent_amount"] ?> /=</td>
                                            <td style="text-align: right;"><?php echo ($row["commission"] * ($row["rent_amount"]) / 100) ?> /=</td>
                                            <td style="text-align: right;"><?php echo ((100 - $row["commission"]) / 100 * ($row["rent_amount"])) ?> /=</td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="8" style="text-align: center;">Total :</td>
                                        <th style="text-align: right;"><?php echo $total; ?> /=</th>
                                        <th style="text-align: right;"><?php echo $comm; ?> /=</th>
                                        <th style="text-align: right;"><?php echo $bal; ?> /=</th>
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
                <h2>
                    Expenses
                </h2>
                <div class="panel-heading">
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <?php
                        echo $ym = $y . '-' . sprintf("%02s", $m);
//                                echo '<br/>';
//                                echo sprintf("%02s", 12);
                        $sql = "SELECT p.plot_id, p.lid, l.lid,"
                                . " e.plot_id,  e.title, e.amount, e.date_added, e.added_by"
                                . " FROM plots p, landlords l, expenses e"
                                . " WHERE e.plot_id=p.plot_id  AND e.t=1 AND l.lid=p.lid AND p.lid='$l' AND e.date_added LIKE '$ym%'";
                        $res = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($res == true) {
                            ?>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <tr>
                                    <th>#</th>
                                    <th>Plot ID</th>
                                    <th>title</th>
                                    <th>Date incurred</th>
                                    <th>Added by</th>
                                    <th>Amount</th>
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
                <h2>
                    Balance Payable: <?php echo ($bal - $exp) ?> /=
                </h2>
                Prepared By: The System.
            </div>

            <!--  End  Striped Rows Table  -->
        </div>


    </div>
</div>

<?php
require_once './footer.php';

