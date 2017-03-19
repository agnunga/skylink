<!--  page-wrapper -->
<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Agent Dashboard</h1>
        </div>
        <!--End Page Header -->
    </div>

    <div class="row">
        <!-- Welcome -->
        <div class="col-lg-12">
            <div class="alert alert-info">
                <i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Welcome Back
                <strong>
                    <?php echo ((!isset($_SESSION['login_user1'])) ? 'SKYLINK AGENT' : $_SESSION['login_user1']); ?>
                </strong>
                <i class="fa  fa-pencil"></i><b>&nbsp; </b>
            </div>

            <div class="alert alert-info">
                <i class="fa fa-folder-open"></i>&nbsp;These are your daily duties in the System
                &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <b>for instructions go to the bottom of the Page at the instructions tab</b>
            </div>
        </div>
        <!--end  Welcome -->
    </div>


    <ul class="nav">
        <div class="row">
            <ul class="nav">
                <a href="receive_rent.php" >
                    <li> <div class="col-lg-3"> 
                            <div class="alert alert-danger text-center">
                                <i class="fa fa-calendar fa-3x"></i><br/>
                                <b>Receive Rent and Others</b> 

                            </div> 
                        </div>
                    </li></a>	
                <a href="mpesa_transactions.php" >
                    <li> <div class="col-lg-3"> 
                            <div class="alert alert-success text-center">
                                <i class="fa fa-phone-square fa-3x"></i><br/>
                                <b>M-PESA Transactions</b> 

                            </div> 
                        </div>
                    </li></a>	


                <a href="rent_statement.php" >
                    <li><div class="col-lg-3">
                            <div class="alert alert-info text-center">
                                <i class="fa fa-dollar fa-3x"></i><br/>
                                <b>Rent Statement</b> 

                            </div>
                        </div> 
                    </li></a>

                <a href="record_expense.php" >
                    <li><div class="col-lg-3">
                            <div class="alert alert-success text-center">
                                <i class="fa  fa-pencil-square-o fa-3x"></i><br/>
                                <b>Record Expense/Voucher</b>
                            </div>
                        </div>	
                    </li></a>
                <a href="view_tenants.php" >
                    <li><div class="col-lg-3">
                            <div class="alert alert-info text-center">
                                <i class="fa fa-users fa-3x"></i><br/>
                                <b>View the List of Tenants</b>

                            </div>
                        </div> 
                    </li></a>
                <a href="view_landlords.php">
                    <div class="col-lg-3">
                        <div class="alert alert-success text-center">
                            <i class="fa  fa-users fa-3x"></i><br/>
                            <b>View the Landlords</b> 
                        </div>
                    </div>
                </a>
                <a href="view_vacants.php">
                    <div class="col-lg-3">

                        <div class="alert alert-danger text-center">
                            <i class="fa fa-eye-slash fa-3x"></i><br/>
                            <b>View List of Vacant Houses</b>

                        </div>
                    </div>
                </a>
                <a href="view_property.php">
                    <div class="col-lg-3">
                        <div class="alert alert-warning text-center">
                            <i class="fa  fa-home fa-3x"></i><br/>
                            <b>View the List of Property </b>
                        </div>

                    </div>
                </a>
                <a href="add_property.php">
                    <div class="col-lg-3">
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-home fa-3x"></i><br/>
                            <b>Add a New Property</b>

                        </div>
                    </div>
                </a>

                <a href="cash_flow.php">
                    <li> <div class="col-lg-3"> 
                            <div class="alert alert-info text-center">
                                <i class="fa fa-money fa-3x"></i><br/>
                                <b>Landlord Cash Flow </b> 

                            </div> 
                        </div>
                    </li></a>	
                <a href="cash_book.php">
                    <li> <div class="col-lg-3"> 
                            <div class="alert alert-info text-center">
                                <i class="fa fa-money fa-3x"></i><br/>
                                <b>Daily Cash Book </b> 

                            </div> 
                        </div>
                    </li></a>	

                <a href="add_landlord.php" >
                    <li><div class="col-lg-3">
                            <div class="alert alert-warning text-center">
                                <i class="fa  fa-pencil fa-3x"></i><br/>
                                <b>Add a New Landlord </b>                    </div>
                        </div>
                    </li>
                </a>
                <!--                <a href="deposit_payment.php" >
                                    <li><div class="col-lg-3">
                                            <div class="alert alert-success text-center">
                                                <i class="fa  fa-dedent fa-3x"></i><br/>
                                <b>Deposit Payment</b>  
                                            </div>
                                        </div>	
                                    </li></a>-->

                <a href="take_to_bank.php" >
                    <li><div class="col-lg-3">
                            <div class="alert alert-warning text-center">
                                <i class="fa  fa-money fa-3x"></i><br/>
                                <b>Taken to bank</b>
                            </div>
                        </div>
                    </li>
                </a>
            </ul>
        </div>

        <div class="col-lg-6">
            <!--Pill Tabs   -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Instructions Tabs
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#home-pills" data-toggle="tab">Rent</a>
                        </li>
                        <li><a href="#profile-pills" data-toggle="tab">Tenants</a>
                        </li>
                        <li><a href="#messages-pills" data-toggle="tab">Landlords</a>
                        </li>
                        <li><a href="#settings-pills" data-toggle="tab">Property</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home-pills">
                            <h4>Receive Rent</h4>
                            <p> Receive Rent from  tenant then Print him/her a Receipt </p>
                        </div>
                        <div class="tab-pane fade" id="profile-pills">
                            <h4>Tenants</h4>to
                            <p> you can Add, Delete, View and Edit the list of Tenants in the system</p>
                        </div>
                        <div class="tab-pane fade" id="messages-pills">
                            <h4>Landlords</h4>
                            <p>You can Add, Delete, View and Edit the list of Landlords in the system</p>
                        </div>
                        <div class="tab-pane fade" id="settings-pills">
                            <h4>Property</h4>
                            <p>ou can Add, Delete, View and Edit the list of Property in the system</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Pill Tabs   -->
        </div>
</div>
<!--End Pill Tabs   -->