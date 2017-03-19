<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php"); 
Session::confirm_logged_in('login_user');

    require_once './header.php';
    ?>
    <!--MENU SECTION END-->
    <div class = "content-wrapper">
        <div class = "container">
            <div class = "row">
                <div class = "col-md-12">
                    <h1 class = "page-head-line">View houses</h1>
                </div>
            </div>

            <div class = "row">
                <div class = "col-md-69">
                    <!--Striped Rows Table -->
                    <div class = "panel panel-default">
                        <div class = "panel-heading">
                            Houses For Skylink Agencies
                        </div>
                        <div class = "panel-body">


                            <div class="table-responsive">
                                <?php
                                $sql = "SELECT r.room_number, r.plot_id, r.status, r.room_type, r.deposit, r.rent, p.lid, p.plot_id, p.estate"
                                        . " FROM rooms r, plots p "
                                        . "WHERE r.plot_id = p.plot_id ORDER BY r.id ASC ";
                                $res = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($res == true) {
                                    ?>

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Plot ID</th>
                                                <th>RoomNo</th>
                                                <th>Estate</th>
                                                <th>Deposit</th>
                                                <th>Rent</th>
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
                                                    <td><?php echo $row["plot_id"] ?></td>
                                                    <td><?php echo $row["room_number"] ?></td>
                                                    <td><?php echo $row["estate"] ?></td>
                                                    <td><?php echo $row["deposit"] ?></td>
                                                    <td><?php echo $row["rent"] ?></td>
                                                    <td><?php echo $row["lid"] ?></td>
                                                    <td><?php echo $row["room_type"] ?></td>
                                                    <td><?php echo $row["status"] ?></td>
                                                    <td>
                                                        <button id="delete_btn" onclick="delete_btn()" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                                                        <script>
                                                            function delete_btn() {
                                                                if (confirm('Delete! Are you sure?')) {
                                                                    alert('Deleting');
                                                                }
                                                            }
                                                        </script>
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

    