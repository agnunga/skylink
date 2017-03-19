<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php"); 
Session::confirm_logged_in('login_user');

    require_once './header.php';?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">View houses</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-69">
                        <!--    Striped Rows Table  -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Houses For Skylink Agencies
                            </div>
                            <div class="panel-body">

                                <?php
                                $sql = "SELECT r.room_number, r.plot_id, r.status, r.room_type, r.rent, p.owner, p.plot_id, p.estate"
                                        . " FROM rooms r, plots p "
                                        . "WHERE r.plot_id = p.plot_id ORDER BY r.id ASC ";
                                $res = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($res == true) {
                                    ?>


                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Vacant rooms No</th>
                                                    <th>Plot ID</th>
                                                    <th>Estate</th>
                                                    <th>Rent per room</th>
                                                    <th>Owner</th>
                                                    <th>Room type</th>
                                                    <th>State</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($res as $row) {

                                                    $i++;
                                                    ?>

                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $row["room_number"] ?></td>
                                                        <td><?php echo $row["plot_id"] ?></td>
                                                        <td><?php echo $row["estate"] ?></td>
                                                        <td><?php echo $row["rent"] ?></td>
                                                        <td><?php echo $row["owner"] ?></td>
                                                        <td><?php echo $row["room_type"] ?></td>
                                                        <td><?php echo $row["status"] ?></td>
                                                        <td>
                                                            <!--<button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button>-->
                                                            <a href="?rn=<?php echo $row['room_no']; ?>&msc=qvbggh4bjh4bnjhgbn" class='btn btn-sm btn-danger'> Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                } else {
                                    echo '<script type="text/javascript"> alert ("Account successfully Created!!!");' . ' ' .
                                    '';
                                    echo "very wrong";
                                }
                                ?> 


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

    