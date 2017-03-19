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
                    <h1 class="page-head-line">Add an Agent </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-69">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            CREATE AN AGENT'S ACCOUNT
                        </div>
                        <div class="panel-body">
                            <form id="form1" action="submit_agents.php" name="form1" method="post" >
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" class="form-control" id="Textfield1" placeholder="Enter Firstname" required="required" name="firstname" />
                                </div>
                                <div class="form-group">
                                    <label>Secondname</label>
                                    <input type="text" class="form-control" id="Textfield2" placeholder="Enter Secondname" required="required" name="lastname" />
                                </div>
                                <div class="form-group">
                                    <label>Phonenumber</label>
                                    <input type="int" class="form-control" id="Textfield3" placeholder="Enter Phonenumber" required="required" name="phone"/>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="Textfield4" placeholder="Password" required="required" name="password"/>
                                </div>



                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" /> Allow Privileges of an Agent
                                    </label>
                                </div>
                                <div class="panel-footer">

                                    <input type = "submit" value = " Submit " width="100%"
                                           class="btn btn-default btn-block" name="submit"/>

                                </div>
                                <hr />

                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php
    require_once './footer.php';

    
