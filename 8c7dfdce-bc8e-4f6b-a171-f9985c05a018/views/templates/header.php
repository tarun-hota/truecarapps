<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!--base css styles-->
    <link rel="stylesheet" href="<?php echo CSSPATH; ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo CSSPATH; ?>font-awesome.min.css">

    <!--page specific css styles-->

    <!--flaty css styles-->
    <link rel="stylesheet" href="<?php echo CSSPATH; ?>flaty.css">
    <link rel="stylesheet" href="<?php echo CSSPATH; ?>flaty-responsive.css">

    <!-- datepicker css -->
    <link rel="stylesheet" href="<?php echo CSSPATH; ?>datepicker.css">

    <!-- datatable css -->
<!--    <link rel="stylesheet" href="--><?php //echo CSSPATH;?><!--dataTables.bootstrap.css">-->

    <link rel="shortcut icon" href="<?php echo IMAGEPATH; ?>favicon.png">
</head>
<body>

<!-- BEGIN Navbar -->
<div id="navbar" class="navbar">
    <button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
        <span class="fa fa-bars"></span>
    </button>
    <a class="navbar-brand" href="#">
        <img src="<?php echo IMAGEPATH; ?>logo12.png" alt="logo" width="65%" />
    </a>
    <div class="dashboard-txt"><div class="dashboard-txt1"><?php echo $this->session->userdata('DISPLAY_NAME'); ?></div>
        <!-- BEGIN Navbar Buttons -->
        <ul class="nav flaty-nav pull-right">
            <li>
                <a href="#"><i class="fa fa-globe"></i>View Site</a></li>
            <!-- BEGIN Button User -->
            <li class="user-profile">
                <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                    <img class="nav-user-photo" src="<?php echo IMAGEPATH; ?>avatar1.jpg" alt="Penny's Photo" />
                    <span class="hhh" id="user_info">
                        <?php echo $this->session->userdata('FIRST_NAME') . ' ' . $this->session->userdata('LAST_NAME');  ?>
                    </span>
                    <i class="fa fa-caret-down"></i>
                </a>

                <!-- BEGIN User Dropdown -->
                <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                    <li class="nav-header">
                        <i class="fa fa-clock-o"></i>
                        Logined From <?php echo $this->session->userdata('LOGINFROM');?>
                    </li>

                    <li>
                        <a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>account">
                            <i class="fa fa-cog"></i>
                            Account Settings
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>profile">
                            <i class="fa fa-user"></i>
                            Edit Profile
                        </a>
                    </li>

                    <li class="divider visible-xs"></li>

<!--                    
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
                    </li>-->

                    <li class="divider"></li>

                    <li>
                        <a id="" href="<?php echo base_url()?>login/logout">
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
     
