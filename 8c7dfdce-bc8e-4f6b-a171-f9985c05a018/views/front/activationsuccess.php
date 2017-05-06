<!DOCTYPE html>

<html lang="en">

    <head>

        <!-- Meta, title, CSS, favicons, etc. -->

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title;?></title>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet"> 

        <link href="<?php echo FORNTCSS;?>bootstrap.css" rel="stylesheet">

        <link href="<?php echo FORNTCSS;?>style.css" rel="stylesheet">

        <link href="<?php echo FORNTCSS;?>font-awesome.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        
        <script src="js/html5shiv.min.js"></script>
        
        <![endif]-->

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo FORNTIMAGES;?>apple-touch-icon-144-precomposed.png">

        <link rel="shortcut icon" href="<?php echo FORNTIMAGES;?>favicon.png">

    </head>





    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">



        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="header-top"><div class="container"><i class="fa fa-phone"></i>Call Us on: <a href="tel:8962452263">8962452263</a></div></div>

            <div class="container">

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">

                        <i class="fa fa-bars"></i>

                    </button>

                    <a class="navbar-brand page-scroll" href="#page-top"><img src="<?php echo FORNTIMAGES;?>logo.png" alt=""></a>

                </div>



                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">

                    <ul class="nav navbar-nav">

                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->

                        <li><a class="page-scroll" href="#page-top">Home</a></li>

                        <li><a class="page-scroll" href="#registration">Registration</a></li>

                        <li><a class="page-scroll" href="#contact">Contact</a></li>

                        <li><a data-toggle="modal" data-target="#myModal" href="#">Login</a></li>

                    </ul>

                </div>

                <!-- /.navbar-collapse -->

            </div>

            <!-- /.container -->

        </nav>





        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title" id="myModalLabel">LOGIN</h4>

                    </div>

                    <div class="modal-body">

                        <div class="modal-login">

                            <form action="#" method="post">

                                <div class="form-group">

                                    <label>Email address</label>

                                    <input class="form-control" id="" placeholder="Enter email" aria-invalid="false" type="email">

                                </div>

                                <div class="form-group">

                                    <label>Password</label>

                                    <input class="form-control" id="" placeholder="Password" aria-invalid="false" type="password">

                                </div>

                                <div class="form-group">

                                    <div class="checkbox">

                                        <label><input type="checkbox"> Remember Me</label>

                                    </div>

                                </div>

                                <div><input type="submit" value="LOGIN"></div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>





        <header class="header">

            <div class="banner"><img src="<?php echo FORNTIMAGES;?>art-916977_1920.jpg" alt=""></div>

        </header>



        <div class="anchor">

            <div class="section-one" style="background-image:url(<?php echo FORNTIMAGES;?>reempaque.jpg)">

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="content" style="min-height: 260px !important;">

                                <h1>Account Activation Message</h1>
                                <?php if($success==TRUE){?>
                                    <p class="col-lg-12 alert alert-success" id="#success">Your email address has been verified.Your account has been activated.Click Login to access your profile in Menu<i class="close smaller">x</i></p>
                                <?php }else{?>
                                     <p class="col-lg-12 alert alert-warning" id="#warning">403:Bad Request Or technical Problem.<i class="close smaller">x</i></p>
                                <?php }?>
                            </div>

                        </div>                     

                    </div>

                </div>

            </div>

        </div>





      <div class="anchor" id="registration">

            <div class="section-two" style="background-image:url(<?php echo FORNTIMAGES;?>truck-wallpaper.jpg)">

                <div class="container">

                    <div class="content">

                        <h3>REGISTRATION</h3>

                        <?php echo form_open('home/registration',['name'=>'frm_driver_registration','id'=>'frm_driver_registration','onsubmit'=>'return false','method'=>'POST'])?>

                            <div class="row">
                                <div class="col-lg-10 alert alert-success hide form-control " id="success"></div>
                                <div class="col-lg-10 alert alert-info hide form-control " id="warning"></div>
                                <div class="col-sm-6 form-group"><label>First Name</label>
                                    <input name="driver_firstname" id="driver_firstname" type="text" class="form-control" value=""/><div id="error_user_first_name" class="error_div"></div></div>
                                <div class="col-sm-6 form-group"><label>Middle Name</label>
                                    <input name="driver_middlename" id="driver_middlename" type="text" class="form-control" value=""/><div id="error_driver_middlename" class="error_div"></div></div>
                                <div class="col-sm-6 form-group"><label>Last Name</label>
                                    <input name="driver_lastname" id="driver_lastname" type="text" class="form-control" value=""/><div id="error_driver_lastname" class="error_div"></div></div>
                                <div class="col-sm-6 form-group"><label>Email</label>
                                    <input name="driver_email" id="driver_email" type="text" class="form-control" value=""/><div id="error_driver_email" class="error_div"></div></div>

                                <div class="col-sm-6 form-group"><label>Password</label>
                                    <input name="driver_password" id="driver_password" type="password" class="form-control" value=""/><div id="error_driver_password" class="error_div"></div></div>

                                <div class="col-sm-6 form-group"><label>Confirm Password</label>
                                    <input name="driver_c_password" id="driver_c_password" type="password" class="form-control" value=""/><div id="error_driver_c_password" class="error_div"></div></div>

                                

                                <div class="col-sm-6 form-group">

                                    <div class="checkbox-inline"><label class="checkbox"><input type="checkbox">Checkbox Value #1</label></div>

                                    <div class="checkbox-inline"><label class="checkbox"><input type="checkbox">Checkbox Value #2</label></div>

                                </div>

                                <div class="col-sm-6 form-group">

                                    <div class="radio-inline"><label class="radio"><input type="radio" name="r">Radio Value #1</label></div>

                                    <div class="radio-inline"><label class="radio"><input type="radio" name="r">Radio Value #2</label></div>

                                </div>

                                <div class="col-sm-12 text-center">
                                    <input type="hidden" value="<?php echo base_url()?>" name="base_url" id="base_url"/>
                                    <input type="submit" id="sub_driver_registration" name="sub_driver_registration" value="Submit"></div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>









        <div class="anchor" id="contact">

            <section class="contact-wrap"style="background-image:url(<?php echo FORNTIMAGES;?>contact-bg.jpg)">

                <div class="container">

                    <h4>Contact Us</h4>



                    <div class="row">

                        <div class="col-md-6">

                            <form action="#" method="post">

                                <div class="row">

                                    <div class="col-sm-6 form-group"><input type="text" class="form-control" placeholder="Name" required></div>

                                    <div class="col-sm-6 form-group"><input type="text" class="form-control" placeholder="Email" required></div>

                                    <div class="col-sm-6 form-group"><input type="text" class="form-control" placeholder="Phon" required></div>

                                    <div class="col-sm-6 form-group"><input type="text" class="form-control" placeholder="Location" required></div>

                                    <div class="col-sm-12 form-group"><textarea class="form-control" placeholder="Message"></textarea></div>

                                    <div class="col-sm-12 text-right">

                                        <input type="submit" value="SEND TO US">

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="col-md-6">

                            <div class="embed-responsive embed-responsive-4by3">

                                <iframe class="embed-responsive-item" style="border:0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48363.38936933083!2d-73.98671186938435!3d40.746365916129626!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b30eac9f%3A0xaca05ca48ab5ac2c!2s350+5th+Ave%2C+New+York%2C+NY+10118%2C+USA!5e0!3m2!1sen!2smy!4v1430753807808"></iframe>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>



        <footer class="footer">

            <div class="footer-top">

                <div class="container">

                    <div class="row">

                        <div class="col-sm-12 col-md-5 col-lg-5">

                            <h5>About Us</h5>

                            <p>Qui inani honestatis comprehensam in, usu id nusquam honestatis consequuntur, quo ut harum fierent phaedrum. Ut falli persequeris ius. An duis feugait nostrum usu, duo an modus nonumy elaboraret. Disputando liberavisse per ea, minim percipitur no usu.</p>

                            <p>Partiendo referrentur ut vim, in aliquip noluisse atomorum has, detraxit indoctum cotidieque no mel.</p>

                        </div>

                        <div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-0 col-sm-6 col-ms-offset-0">

                            <h5>navigation</h5>

                            <ul class="footer-nav">

                                <li><a class="page-scroll" href="#page-top">Home</a></li>

                                <li><a class="page-scroll" href="#registration">Registration</a></li>

                                <li><a class="page-scroll" href="#contact">Contact</a></li>

                                <li><a class="page-scroll" href="#">Login</a></li>

                            </ul>

                        </div>

                        <div class="col-md-4 col-lg-3 col-sm-6">

                            <h5>Contact Information</h5>

                            <ul class="footcontact">

                                <li class="address">
                                <?php echo $siteinfo?$siteinfo->address :''?>

                                </li>

                                <li class="phn">Tel: <?php echo $siteinfo?$siteinfo->contact_nos:'000-000-0000'?></li>

                                <li class="email"><a href="mailto: info@yourmail.com "> <?php echo $siteinfo?$siteinfo->infoemailaddress:'you@yourdomain.com'?> </a></li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

            <div class="footer-bottom"><div class="container">© 2017 COMPANY NAME. All rights reserved.</div></div>

        </footer>

        <!-- Bootstrap core JavaScript================================================== -->

        <!-- Placed at the end of the document so the pages load faster -->

        <script src="<?php echo FORNTJS;?>jquery.min.js"></script>

        <script src="<?php echo FORNTJS;?>bootstrap.js"></script>

        <script src="<?php echo FORNTJS;?>custom.js"></script>

        <script src="<?php echo FORNTJS;?>jquery.easing.min.js"></script>

        <script src="<?php echo FORNTJS;?>parallax.min.js"></script>
        <script src="<?php echo FORNTJS;?>site/home.js"></script>
    </body>

</html>