<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $title; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!--base css styles-->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!--page specific css styles-->

        <!--flaty css styles-->
        <link rel="stylesheet" href="css/flaty.css">
        <link rel="stylesheet" href="css/flaty-responsive.css">

        <link rel="shortcut icon" href="images/favicon.png">
    </head>
    <body>

        <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar">
            <button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="images/logo1.png" alt="logo" />
            </a>
            <div class="dashboard-txt"><div class="dashboard-txt1">Super Administrator</div>
                <!-- BEGIN Navbar Buttons -->
                <ul class="nav flaty-nav pull-right">
                    <li>
                        <a href="#"><i class="fa fa-globe"></i>View Site</a></li>
                    <!-- BEGIN Button User -->
                    <li class="user-profile">
                        <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                            <img class="nav-user-photo" src="images/avatar1.jpg" alt="Penny's Photo" />
                            <span class="hhh" id="user_info">
                                Penny
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </a>

                        <!-- BEGIN User Dropdown -->
                        <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                            <li class="nav-header">
                                <i class="fa fa-clock-o"></i>
                                Logined From 20:45
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-cog"></i>
                                    Account Settings
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    Edit Profile
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-question"></i>
                                    Help
                                </a>
                            </li>

                            <li class="divider visible-xs"></li>

                            <li class="visible-xs">
                                <a href="#">
                                    <i class="fa fa-tasks"></i>
                                    Tasks
                                    <span class="badge badge-warning">4</span>
                                </a>
                            </li>
                            <li class="visible-xs">
                                <a href="#">
                                    <i class="fa fa-bell"></i>
                                    Notifications
                                    <span class="badge badge-important">8</span>
                                </a>
                            </li>
                            <li class="visible-xs">
                                <a href="#">
                                    <i class="fa fa-envelope"></i>
                                    Messages
                                    <span class="badge badge-success">5</span>
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                        <!-- BEGIN User Dropdown -->
                    </li>
                    <!-- END Button User -->
                </ul>
                <!-- END Navbar Buttons -->
            </div></div>
        <!-- END Navbar -->
        
<!-- BEGIN Container -->
<div class="container" id="main-container">