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
                    <h1 class="page-head-line">View Expenses For: 

                        <?php
                        echo $m = (isset($_POST['l_cash_flow']) ? $_POST['month'] : date('m') - 1);
                        echo '/';
                        echo $y = (isset($_POST['l_cash_flow']) ? $_POST['year'] : date('Y'));
                        $date_m = $y . '-' . $m;
                        ?>

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
                                    <label>Month: </label>
                                    <select class="form-control input-sm" name="month">
                                        <option value="<?php echo $m; ?>"><?php echo $m; ?></option>

                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo "<option value = '$i'>$i</option>";
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
                                $sql = "SELECT * FROM `expenses` WHERE date_added LIKE '$date_m%' AND t=1 ORDER BY `id` DESC";
                                $res = mysqli_query($conn, $sql);
                                $total = 0;
                                $i = 0;
                                if ($res == true) {
                                    ?>

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-exampleXXX ">
                                        <thead>
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
                                                $total+=$row["amount"];
                                                $i++;
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row["plot_id"] ?></td>
                                                    <td><?php echo $row["title"] ?></td>
                                                    <td><?php echo $row["date_added"] ?></td>
                                                    <td><?php echo $row["added_by"] ?></td> 
                                                    <td style="text-align: right;"><?php echo $row["amount"] ?> /=</td>
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
                                                <td colspan="5" style="text-align: center;">Total :</td>
                                                <th style="text-align: right;"><?php echo $total; ?> /=</th>
                                            </tr>

                                        <script>
                                            function overwrite_txn(id) {
                                                if (confirm("Overwrite Transaction!Are you sure?")) {
                                                    window.location.href = 'view_expenses.php?i=' + id + '&olo=gjytfjhtfjyhgjtydhgtf';
                                                    alert('view_expenses.php?i=' + id + '&olo=gjytfjhtfjyhgjtydhgtf');
                                                }
                                            }
                                        </script>
                                        <?php
                                        if (isset($_GET['i'])) {
                                            $j = $_GET['i'];
                                            echo $j;
                                            $sql = "UPDATE `expenses` SET `t` = '0' WHERE `expenses`.`id` = $j";
                                            $res = mysqli_query($conn, $sql);
                                            if ($res == true) {
                                                echo $i . 'Overwritten';
                                                echo '<script> alert ("Entry Overwritten Successfully!!");</script>';
                                                echo '<script> window.location.href=\'view_expenses.php\';</script>';
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
                                    echo '<script type="text/javascript"> alert ("Account successfully Created!!!");' . ' ' .
                                    '';
                                    echo "very wrong";
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

    