<?php

require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php"); 
Session::confirm_logged_in('login_user');

    require_once './header.php';

    if (isset($_GET['pn'])) {
        $plot = $_GET['pn'];
        $sql = "DELETE FROM plots WHERE plot_id='$plot'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '<script> alert ("Plot Deleted Successfully!!");'
            . ' window.location.href=\'View_property.php\';</script>';
        } else {
            echo '<script> alert ("' . mysqli_error($conn) . '")';
        }
    }
    ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">
                        List of Skylink Property</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-69">
                    <!--    Striped Rows Table  -->
                    <div class="panel panel-default">
<!--                        <div class="panel-heading">
                        </div>-->

                        <div class="table-responsive">
                            <?php
                            $sql = "SELECT * FROM `plots` ORDER BY `id` DESC";
                            $res = mysqli_query($conn, $sql);
                            $i = 0;
                            if ($res == true) {
                                ?>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Plot ID</th>
                                            <th>Estate</th>
                                            <th>No of rooms</th>
                                            <th>Owner</th>  
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
                                                <td><?php echo $row["estate"] ?></td>
                                                <td><?php echo $row["room_no"] ?></td>
                                                <td><?php echo $row["lid"] ?></td>
                                                <td>
                                                    <div class="col-sm-6">
                                                        <form method="post" action="view_property_details.php">
                                                            <input type="hidden" value="<?php echo $row["plot_id"] ?>" name="plot_id" readonly="">
                                                            <input type="submit" value="View houses" name="details" class="btn btn-sm btn-primary">
                                                        </form>                                                        
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button onclick="delete_plot('<?php echo $row["plot_id"]
                                                ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                                    </div>

                                                </td>
                                        <script>
                                            function delete_plot(pid) {
                                                if (confirm("Delete!Are you sure?")) {
                                                    window.location.href = 'View_property.php?pn=' + pid + '&olo=gjytfjhtfjyhgjtydhgtf';
                                                    //                                                    alert('View_property.php?pn=' + pid + '&olo=gjytfjhtfjyhgjtydhgtf');
                                                }
                                            }
                                        </script>
                                        </tr>
                                        <?php
                                    }

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

    
    