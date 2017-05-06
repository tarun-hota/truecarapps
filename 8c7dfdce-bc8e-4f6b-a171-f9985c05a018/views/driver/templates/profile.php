  
   
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="fa fa-file-user"></i>Manage Profile </h1>
            <h4>Your Profile</h4>
        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url().$this->session->userdata('REDIRECT_URL')?>dashboard">Home</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active">My Profile</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->
 

    <div class="row" >
        <div class="col-md-12">
            <div class="box box-black">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i> Update My Profile</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class=" alert alert-success col-sm-12 col-md-12"></div>
                    <div class=" alert alert-danger  col-sm-12 col-md-12"></div>
                                 
                        <?php echo form_open(base_url().DRIVER_ROOT.'profile/create', ['name'=>'myprofileform','id'=>'myprofileform','method'=>'post','class'=>'form-horizontal'])?>
                        
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">First Name</label>
                            <div class="col-sm-5 col-lg-3 controls">
                                <input type="text" name="userfirstname" id="userfirstname" value="<?php echo $user_profile?$user_profile->first_name:'';?>" class="form-control" />
                            </div>
                            <label class="col-sm-3 col-lg-2 control-label">Middle Name</label>
                            <div class="col-sm-5 col-lg-3 controls">
                                <input type="text" name="usermiddlename" id="usermiddlename" value="<?php echo $user_profile?$user_profile->middle_name:'';?>" class="form-control" />
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Last Name</label>
                            <div class="col-sm-5 col-lg-3 controls">
                                <input type="text" name="userlastname" id="userlastname" value="<?php echo $user_profile?$user_profile->last_name :'';?>" class="form-control" />
                            </div>
                            <label class="col-sm-3 col-lg-2 control-label">Email</label>
                            <div class="col-sm-5 col-lg-3 controls">
                                <input type="text" name="useremail" readonly="readonly" id="useremail" value="<?php echo $user_profile?$user_profile->emailid :'';?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Social security No</label>
                            <div class="col-sm-5 col-lg-3 controls">
                                <input class="date-picker form-control" name="usersocialsecurityno" placeholder="social Security No" id="usersocialsecurityno"  size="16" type="text" value="<?php echo $user_profile?$user_profile->social_sequrityno:'';?>" />
                            </div>
                            <label class="col-sm-3 col-lg-2 control-label">Driving License No</label>
                            <div class="col-sm-5 col-lg-3 controls">
                                <input class="date-picker form-control" name="userdrivinglincenseno" placeholder="Driving License No" id="userdrivinglincenseno"  size="16" type="text" value="<?php echo $driver_truckinfo?$driver_truckinfo->driving_licence_no:'';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Address</label>
                            <div class="col-sm-3 col-md-1 col-lg-2 controls">
                                <input type="text" name="useraddress" placeholder="Street Details" id="useraddress" value="<?php echo $user_profile?$user_profile->address :'';?>" class="form-control" />
                            </div>
                            <div class="col-sm-3col-md-1 col-lg-2 controls">
                                <input type="text" name="usercityorvill" placeholder="City" id="usercityorvill" value="<?php echo $user_profile?$user_profile->city:'';?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label"></label>
                            <div class="col-sm-3 col-md-1 col-lg-2 controls">
                                <input type="text" name="userstate" placeholder="State" id="userstate" value="<?php echo $user_profile?$user_profile->state :'';?>" class="form-control" />
                            </div>
                            <div class="col-sm-3 col-md-1 col-lg-2 controls">
                                <input type="text" name="userzipcode" placeholder="Zipcode" id="userzipcode" value="<?php echo $user_profile?$user_profile->pincode :'';?>" class="form-control" />
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Cell Phone I</label>
                            <div class="col-sm-5 col-lg-3 controls">
                                <input type="text" name="usercontactno[]" id="usercontactnoc" value="" class="form-control" />
                            </div>
                            <label class="col-sm-3 col-lg-2 control-label">Cell Phone II</label>
                            <div class="col-sm-5 col-lg-3 controls">
                                <input type="text" name="usercontactno[]" id="usercontactnow" value="" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Truck Reg No</label>
                            <div class="col-sm-5 col-md-3 col-lg-3 controls">
                                <input type="text" name="usertruckregno" placeholder="Truck Registration No" id="usertruckregno" value="<?php echo $driver_truckinfo?$driver_truckinfo->truck_reg_no:'';?>" class="form-control" />
                            </div>
                            <label class="col-sm-3 col-lg-2 control-label">Rate</label>
                            <div class="col-sm-3col-md-1 col-lg-2 controls">
                                <input type="text" name="usertruckrate" placeholder="Rate Per Km or Mile" id="usertruckrate" value="<?php echo $driver_truckinfo?$driver_truckinfo->rate:'';?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Rate Per</label>
                            <div class="col-sm-5 col-md-3 col-lg-3 controls">
                                <select name="userrateperkmmile" id="userrateperkmmile" class="form-control">
                                    <option value="-1" >select One</option>
                                    <option value="Km" <?php echo $driver_truckinfo && $driver_truckinfo->rate_per_unit=='Km'?'selected="selected"':'';?>>Kilometer</option>
                                    <option value="Mile" <?php echo $driver_truckinfo && $driver_truckinfo->rate_per_unit=='Mile'?'selected="selected"':'';?>>Mile</option>
                                </select>
                                
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                <input type="hidden" name="hiddentruckinfoid" value="<?php echo $driver_truckinfo?$driver_truckinfo->truckinfoid:''?>"/>
                                <input type="submit" name="sbteditprofile" class="btn btn-primary" value="Submit"/>                                
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
<!--        <div class="col-md-6">
            <div class="box box-black">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i> Edit Profile Picture</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        
                    </div>
                </div>
                <div class="box-content">
                    <?php //echo form_open_multipart(base_url().DRIVER_ROOT.'profile/editprofpic', ['name'=>'myprofilepicform','id'=>'myprofilepicform','method'=>'post','class'=>'form-horizontal'])?>
                    
                        <div class="form-group">
                            <label class="col-sm-3 col-md-3 control-label">Image Upload</label>
                            <div class="col-sm-7 col-md-6 controls">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                        
                                    </div>
                                    
                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 295px; max-height: 350px; line-height: 20px;"><img src="" alt="" /></div>
                                    <div class="clearfix"></div>
                                    <div style="margin-top: 5px;width:180px;">
                                        <span class="btn btn-file" style="width:340px !important;"><span class="fileupload-new">Select image</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input type="file" name="userprofile" class="default" /></span>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                                <span class="label label-important">NOTE!</span>
                                <span>Attached image img-thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-md-8 col-md-offset-4">
                                <input type="hidden" name="hiddudid" value=""/>
                                <input type="submit" name="sbtprofilepic" class="btn btn-primary"value="Submit"/>
                                
                            </div>
                        </div>
                    <?php //echo form_close()?>
                </div>
            </div>
        </div>-->
        <div class="col-md-6">
            <div class="box box-black">
                <div class="box-title">
                    <h3><i class="fa fa-file"></i> Change Password</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>                        
                    </div>
                </div>
                <div class="box-content">
                    <div class=" alert alert-danger   col-sm-12 col-md-12"></div>
                    <?php echo form_open(base_url().DRIVER_ROOT.'profile/changepassword', ['name'=>'myprofilechpassform','id'=>'myprofilechpassform','method'=>'post','class'=>'form-horizontal'])?>
                        <div class="form-group">
                            <label class="col-sm-4 col-md-4 control-label">Current password</label>
                            <div class="col-sm-8 col-md-7 controls">
                                <input type="password" name="useroldpassword" id="useroldpassword" value="" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 col-md-4 control-label">New password</label>
                            <div class="col-sm-8 col-md-7 controls">
                                <input type="password" name="usernewpassword" id="usernewpassword"value="" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 col-md-4 control-label">Re-type new password</label>
                            <div class="col-sm-8 col-md-7 controls">
                                <input type="password" id="userconpassword" name="userconpassword" value="" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4 col-md-7 col-md-offset-5">
                                <input name="sbtchangepassword" id="sbtchangepassword" type="submit" class="btn btn-primary"value="Submit"/>
                                <input type="reset" class="btn" value="Reset"/>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>

<!-- END Main Content -->
