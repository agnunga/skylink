<?php
require_once ("../includes/session.php");
require_once ("../includes/config.php");
require_once ("../includes/redirect.php");
Session::confirm_logged_in('login_user');

require_once './header.php';

if (isset($_GET['pn'])) {
    $phonenumber = $_GET['pn'];
    $sql = "DELETE FROM agents WHERE phonenumber='$phonenumber'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script> alert ("Agent Deleted Successfully!!");'
        . ' window.location.href=\'View_Agents.php\';</script>';
    } else {
        echo '<script> alert ("' . mysqli_error($conn) . '"); '
        . 'window.location.href=\'View_Agents.php\';</script>';
    }
}
?>
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">List of Agents</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-69">
                <!--    Striped Rows Table  -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Agents For Skylink Agencies
                    </div>
                    <div class="panel-body">

                        <?php
                        $sql = "SELECT * FROM `agents` ORDER BY `id` DESC";
                        $res = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($res == true) {
                            ?>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone Number</th>
                                            <th>Password</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($res as $row) {

                                            $i++;
                                            ?>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row["firstname"] ?></td>
                                                <td><?php echo $row["secondname"] ?></td>
                                                <td><?php echo $row["phonenumber"] ?></td>
                                                <td><?php echo $row["password"] ?></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-edit "></i> Edit</button>
                                                    <button onclick="delete_agent('<?php echo $row["phonenumber"] ?>')" class="btn btn-danger btn-sm"><i class="fa fa-pencil"></i> Delete</button>
                                                </td>
                                        <script>
                                            function delete_agent(phone) {
                                                if (confirm("Delete!Are you sure?")) {
                                                    window.location.href = 'View_Agents.php?pn=' + phone + '&olo=gjytfjhtfjyhgjtydhgtf';
                                                    alert('View_Agents.php?pn=' + phone + '&olo=gjytfjhtfjyhgjtydhgtf');
                                                }
                                            }
                                        </script>
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



                        <div class="row" style="text-align: center;
                             "> <a href="add_agent.php" class="btn btn-success btn-lg">Add Agents</a>
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
