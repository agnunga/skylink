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
                            Amount banked
                        </span>

                        <span style="text-align: right;" class="col-sm-4">
                            <?php
                            echo $d = (isset($_POST['l_cash_flow']) ? $_POST['day'] : date('d'));
                            echo '/';
                            echo $m = (isset($_POST['l_cash_flow']) ? $_POST['month'] : date('m'));
                            echo '/';
                            echo $y = (isset($_POST['l_cash_flow']) ? $_POST['year'] : date('Y'));
                            echo ' : ';

                            $date = $y . '-' . $m . '-' . $d;
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
                        </div>
                        <div class="panel-body">

                            <div class="form" style="text-align: right;">
                                <form class="form-inline" method="POST"> 

                                    <label>Day: </label>
                                    <select class="form-control input-sm" name="day">
                                        <option value="<?php echo $d; ?>"><?php echo $d; ?></option>

                                        <?php
                                        for ($i = 1; $i <= 31; $i++) {
                                            echo "<option value = '" . sprintf('%02d', $i) . "'>" . sprintf('%02d', $i) . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label>Month: </label>
                                    <select class="form-control input-sm" name="month">
                                        <option value="<?php echo sprintf('%02d', $m); ?>"><?php echo sprintf('%02d', $m); ?></option>

                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo "<option value = '" . sprintf('%02d', $i) . "'>" . sprintf('%02d', $i) . "</option>";
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

                            <div class="table-responsive">
                                <?php
                                $sql = "SELECT * FROM `to_bank` WHERE `date_added` LIKE '$date%' AND t=1 ORDER BY `id` DESC";
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
                                                <th>Revert</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;

                                            foreach ($res as $row) {
                                                $total += ($row["amount"]);
                                                $i++;
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row["bank"] ?></td>
                                                    <td><?php echo $row["account_no"] ?></td>
                                                    <td><?php echo $row["tid"] ?></td>
                                                    <td><?php echo $row["date_added"] ?></td>
                                                    <td><?php echo $row["added_by"] ?></td>
                                                    <td><?php echo $row["amount"] ?></td>
                                                    <td>
                                                        <div class="">
                                                            <button onclick="overwrite_txn('<?php echo $row["id"]
                                                ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Overwrite Transaction</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="6" style="text-align: center;">Total :</td>
                                                <th><?php echo $total; ?></th>
                                            </tr>

                                        <script>
                                            function overwrite_txn(id) {
                                                if (confirm("Overwrite Transaction!Are you sure?")) {
                                                    window.location.href = 'money_banked.php?i=' + id + '&olo=gjytfjhtfjyhgjtydhgtf';
        //                                                    alert('money_banked.php?i=' + id + '&olo=gjytfjhtfjyhgjtydhgtf');
                                                }
                                            }
                                        </script>
                                        <?php
                                        if (isset($_GET['i'])) {
                                            $j = $_GET['i'];
                                            echo $j;
                                            $sql = "UPDATE `to_bank` SET `t` = '0' WHERE `to_bank`.`id` = $j";
                                            $res = mysqli_query($conn, $sql);
                                            if ($res == true) {
                                                echo $i . 'Overwritten';
//                                                echo '<script> alert ("Entry Overwritten Successfully!!");</script>';
                                                echo '<script> window.location.href=\'money_banked.php\';</script>';
                                            } else {
                                                echo 'WRONG SQL';
                                                echo "very wrong", mysqli_error($conn);
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } else {
                                    echo "very wrong", mysql_error($conn);
                                }
                                ?> 
                            </div>
                        </div>
                    </div> 
                    <!--  End  Striped Rows Table  -->
                </div>
            </div>
        </div>
    </div>	
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php
    require_once './footer.php';

    