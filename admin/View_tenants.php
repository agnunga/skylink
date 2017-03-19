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
                    <h1 class="page-head-line">List of Tenants</h1>
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
                                $sql = "SELECT r.room_number, r.plot_id, r.status, r.room_type, r.rent, p.lid, p.plot_id, p.estate, "
                                        . " t.fname, t.natid, t.phone, t.plot_id, t.room_number, t.added_by, t.created_at, t.modified_by, t.modified_at, t.nok_name, t.nok_phone, t.place_of_wrk, t.t "
                                        . " FROM rooms r, plots p, tenants t "
                                        . " WHERE r.status='1' AND r.plot_id = p.plot_id AND r.plot_id = t.plot_id AND t.t=1 AND r.room_number = t.room_number AND t.t='1'  ORDER BY r.id ASC ";
                                $res = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($res == true) {
                                    ?>

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tenant's name</th>
                                                <th>ID</th>
                                                <th>Phone</th>
                                                <th>RoomNo</th>
                                                <th>Plot ID</th>
                                                <th>Estate</th>
                                                <th>Rent</th>
                                                <th>Landlord</th>
                                                <th>Room type</th>
                                                <th>Kin Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($res as $row) {

                                                $i++;
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row["fname"] ?></td>
                                                    <td><?php echo $row["natid"] ?></td>
                                                    <td><?php echo $row["phone"] ?></td>
                                                    <td><?php echo $row["room_number"] ?></td>
                                                    <td><?php echo $row["plot_id"] ?></td>
                                                    <td><?php echo $row["estate"] ?></td>
                                                    <td><?php echo $row["rent"] ?></td>
                                                    <td><?php echo $row["lid"] ?></td>
                                                    <td><?php echo $row["room_type"] ?></td>
                                                    <td><?php echo $row["nok_phone"] ?></td>
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

    
    
                                