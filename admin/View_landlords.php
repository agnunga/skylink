<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php"); 
Session::confirm_logged_in('login_user');

    require_once './header.php';
    ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">List of landlords</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-69">
                    <!--    Striped Rows Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">

                                <?php
                                $sql = "SELECT * FROM `landlords` ORDER BY `id` DESC";
                                $res = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($res == true) {
                                    ?>

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                                <th>L ID.</th>
                                                <th>ID No.</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Bank</th>
                                                <th>Branch</th>
                                                <th>Account no</th>
                                                <th>Payment day</th>
                                                <th>Added By</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($res as $row) {

                                                $i++;
                                                ?>

                                                <tr>
                                                    <!-- `acc_no`, `pay_day`, `added_by`-->
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row["fname"] ?></td>
                                                    <td><?php echo $row["lid"] ?></td>
                                                    <td><?php echo $row["natid"] ?></td>
                                                    <td><?php echo $row["phone"] ?></td>
                                                    <td><?php echo $row["address"] ?></td>
                                                    <td><?php echo $row["bank"] ?></td>
                                                    <td><?php echo $row["branch"] ?></td>
                                                    <td><?php echo $row["acc_no"] ?></td>
                                                    <td><?php echo $row["pay_day"] ?><sup>th</sup></td>
                                                    <td><?php echo $row["added_by"] ?></td>

                                                    <td><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button>
                                                        <!--button class="btn btn-danger"><i class="fa fa-pencil"></i> Delete</button-->
                                                        <!--<a href="delete_agents.php?pn=<?php echo $row['phonenumber']; ?>" class='delete_icon' title='Delete'> DELETE</td>-->
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } else {

                                    echo "very wrong", mysqli_error($conn);
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

    