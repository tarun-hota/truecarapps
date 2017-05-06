<!-- BEGIN Sidebar -->
<div id="sidebar" class="navbar-collapse collapse">
    <!-- BEGIN Navlist -->
    <ul class="nav nav-list">
        <li class="<?php echo $active_menu=='dashboard'?'active':''?>">
            <a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>dashboard">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="#" class="dropdown-toggle <?php echo in_array($active_menu,['profile','account'])?'active':''?>">
                <i class="fa fa-user"></i>
                <span>My Profile</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>

            <!-- BEGIN Submenu -->
            <ul class="submenu">
                <li><a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>profile">Profile Management</a></li>
                <li><a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>account">Account Management</a></li>
            </ul>
            <!-- END Submenu -->
        </li>
        <?php if($this->session->userdata('USER_STATUS')=='1' && $this->session->userdata('USER_TYPE_ID')==2 ){?>
        <li>
            <a href="#" class="dropdown-toggle <?php echo $active_menu=='route'?'active':''?>">
                <i class="fa fa-road"></i>
                <span>My Route </span>
                <b class="arrow fa fa-angle-right"></b>
            </a>

             
            <ul class="submenu">
                <li><a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>route">Upcoming Route</a></li>
                <li><a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>route/add">Create Route</a></li>
            </ul>
            
        </li>


<!--        <li>
            <a href="#" class="dropdown-toggle">
                <i class="fa fa-usd"></i>
                <span>Investors</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>

             BEGIN Submenu 
            <ul class="submenu">
                <li><a href="#">Demo</a></li>
                <li><a href="#">Demo1</a></li>
            </ul>
             END Submenu 
        </li>-->

<!--        <li>
            <a href="#" class="dropdown-toggle">
                <i class="fa fa-users"></i>
                <span>Request User</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>

             BEGIN Submenu 
            <ul class="submenu">
                <li><a href="#">Demo</a></li>
                <li><a href="#">Demo1</a></li>
            </ul>
             END Submenu 
        </li>-->

<!--        <li>
            <a href="#" class="dropdown-toggle">
                <i class="fa fa-money"></i>
                <span>Request Investors</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>

             BEGIN Submenu 
            <ul class="submenu">
                <li><a href="#">Demo</a></li>
                <li><a href="#">Demo1</a></li>
            </ul>
             END Submenu 
        </li>-->

<!--        <li>
            <a href="box.html">
                <i class="fa fa-file"></i>
                <span>Reports</span>
            </a>
        </li>-->

<!--        <li>
            <a href="calendar.html">
                <i class="fa fa-question"></i>
                <span>Help</span>
            </a>
        </li>-->
        <?php }?>
        <?php if($this->session->userdata('USER_STATUS')=='1' && $this->session->userdata('USER_TYPE_ID')==1 ){?>
        <li>
            <a href="#" class="dropdown-toggle <?php echo $active_menu=='driver'?'active':''?>">
                <i class="fa fa-road"></i>
                <span>Driver Management </span>
                <b class="arrow fa fa-angle-right"></b>
            </a>

             
            <ul class="submenu">
                <li><a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>driver">Driver List</a></li>
                <li><a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>driver/new">New Driver Request</a></li>
            </ul>
            
        </li>


<!--        <li>
            <a href="#" class="dropdown-toggle">
                <i class="fa fa-usd"></i>
                <span>Investors</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>

             BEGIN Submenu 
            <ul class="submenu">
                <li><a href="#">Demo</a></li>
                <li><a href="#">Demo1</a></li>
            </ul>
             END Submenu 
        </li>-->

<!--        <li>
            <a href="#" class="dropdown-toggle">
                <i class="fa fa-users"></i>
                <span>Request User</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>

             BEGIN Submenu 
            <ul class="submenu">
                <li><a href="#">Demo</a></li>
                <li><a href="#">Demo1</a></li>
            </ul>
             END Submenu 
        </li>-->

<!--        <li>
            <a href="#" class="dropdown-toggle">
                <i class="fa fa-money"></i>
                <span>Request Investors</span>
                <b class="arrow fa fa-angle-right"></b>
            </a>

             BEGIN Submenu 
            <ul class="submenu">
                <li><a href="#">Demo</a></li>
                <li><a href="#">Demo1</a></li>
            </ul>
             END Submenu 
        </li>-->

<!--        <li>
            <a href="box.html">
                <i class="fa fa-file"></i>
                <span>Reports</span>
            </a>
        </li>-->

<!--        <li>
            <a href="calendar.html">
                <i class="fa fa-question"></i>
                <span>Help</span>
            </a>
        </li>-->
        <?php }?>

    </ul>
    <!-- END Navlist -->

    <!-- BEGIN Sidebar Collapse Button -->
    <div id="sidebar-collapse" class="visible-lg">
        <i class="fa fa-angle-double-left"></i>
    </div>
    <!-- END Sidebar Collapse Button -->
</div>
<!-- END Sidebar -->
<!-- BEGIN Content -->
<div id="main-content">
