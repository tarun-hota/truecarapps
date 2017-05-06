<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Ganadeb
 */
class Login extends My_Controller{
    public $body_data;
    private $resource_data;
    public function __construct(){
        parent::__construct();
        $this->body_data=[];
        $this->resource_data=FALSE;
        $this->body_data['error_message']='';
        $this->load->helper('cookie');
    }

    
    /**
     * Index view / Default view\
     *
     */
    public function _truecarLoginIndex() {
        if($this->session->userdata('ISLOGIN')) :
            redirect(URL.$this->session->userdata('REDIRECT_URL').'dashboard');
        else:
            $this->body_data['title']='True Car | Login';
            $this->load->view('login/login',$this->body_data,FALSE);
        endif;
    }

    public function _remap($method='index')
    {
        try {
            if(method_exists($this, '_truecarLogin'.ucfirst($method)))
            {
                $this->{"_truecarLogin".ucfirst($method)}();
            }  else {
                throw new Exception("Page Not Found",404);
            }
        } catch (Exception $ex) {
            show_404();
        }

    }
    public function _truecarLoginChecklogindata()
    {
        if($this->input->post('loginSubmit'))
        {
            $this->form_validation->set_rules('username','Login Id','required|xss_clean');
            $this->form_validation->set_rules('password','Password','required|xss_clean');
            if($this->form_validation->run()===FALSE)
            {
                 $this->index();
            }
            else {
                 $this->load->model("login_model");
                 if($this->login_model->checkLoginData())
                 {
                     $this->dataarray['login_data']=$this->login_model->data_resource->row();
                     if($this->dataarray['login_data']->user_status==1)
                     {
                        $this->session->set_userdata('ISLOGIN',TRUE);
                        $this->session->set_userdata('LOGINID',$this->dataarray['login_data']->userid);
                        $this->session->set_userdata('DISPLAYNAME',$this->dataarray['login_data']->loginid);
                        $this->session->set_userdata('USERTYPE',$this->dataarray['login_data']->user_type);
                        $this->login_model->fetchUserData($this->dataarray['login_data']->userid,$this->dataarray['login_data']->user_type);
                        $this->dataarray['user_data']=$this->login_model->data_resource?$this->login_model->data_resource->row():FALSE;
                        if($this->dataarray['user_data'])
                        {

                            $this->session->set_userdata('FULLNAME',  ucwords(str_replace('~',' ',$this->dataarray['user_data']->user_full_name)));
                            $this->session->set_userdata('CONTACTNO',str_replace('~','/',$this->dataarray['user_data']->user_contact_no));
                            $this->session->set_userdata('EMAIL',$this->dataarray['user_data']->user_email);
                            $this->session->set_userdata('USERTYPECODE',$this->dataarray['user_data']->short_code);
                            $this->session->set_userdata('USERTYPENAME',  ucwords($this->dataarray['user_data']->user_type_name));
                            $this->session->set_userdata('EMPLOYEEORCUSTNO',$this->dataarray['user_data']->employee_or_cust_id);
                            $this->session->set_userdata('USERLABELORDER',$this->dataarray['user_data']->user_level_order);
                            $this->session->set_userdata('USERPROPIC',$this->dataarray['user_data']->user_profile_pic);
                            $this->session->set_userdata('USERGENDER',$this->dataarray['user_data']->gender);
                            $this->session->set_userdata($this->dataarray['login_data']->userid,  time()+3600);
                            //save action data message                        
                            $this->action_data['action_log_message']="Login successfull by user id : ".$this->dataarray['login_data']->userid;
                            $this->action_data['action_functionality']='login';
                            $this->action_data['last_modify_by']=$this->session->userdata('LOGINID');                        
                            $this->saveActionLog('login_model');
                            $this->session->set_userdata('USERLASTACCESSTIME',$this->login_model->getLastAccessTime());
                            redirect(URL.$this->session->userdata('REDIRECT_URL').'dashboard'); 
                        }
                        
                     }
                     else if($this->dataarray['login_data']->user_status==0)
                     {   
                        //save action data message
                        $this->action_data['action_log_message']="Try login by blocked user id : ".$this->dataarray['login_data']->userid;
                        $this->action_data['action_functionality']='login';
                        $this->saveActionLog('login_model');
                        $this->session->set_userdata('LOGINMSG','Your account has been blocked.Please contact with site owner');
                        $this->index();
                        $this->session->unset_userdata('LOGINMSG');
                     }
                     else if($this->dataarray['login_data']->user_status==2)
                     {  
                         //save action data message
                        $this->action_data['action_log_message']="Try login by temporary suspended user id : ".$this->dataarray['login_data']->userid;
                        $this->action_data['action_functionality']='login';
                        $this->saveActionLog('login_model');
                        $this->session->set_userdata('LOGINMSG','Your account has been temporary suspended.Please contact with site owner');
                        $this->index();
                        $this->session->unset_userdata('LOGINMSG');
                     }
                     else if($this->dataarray['login_data']->user_status==3)
                     {
                        //save action data message
                        $this->action_data['action_log_message']="Try login by suspended user id : ".$this->dataarray['login_data']->userid;
                        $this->action_data['action_functionality']='login';
                        $this->saveActionLog('login_model');
                        $this->session->set_userdata('LOGINMSG','Your account has been suspended.Please contact with site owner');
                        $this->index();
                        $this->session->unset_userdata('LOGINMSG');
                     }
                     else if($this->dataarray['login_data']->user_status==4)
                     {
                        //save action data message
                        $this->action_data['action_log_message']="Try login by deleted user id : ".$this->dataarray['login_data']->userid;
                        $this->action_data['action_functionality']='login';
                        $this->saveActionLog('login_model'); 
                        $this->session->set_userdata('LOGINMSG','Your account has been deleted from our list.For more information please contact with site owner');
                        $this->index();
                        $this->session->unset_userdata('LOGINMSG');
                     }
                 }
                 else
                 {
                    //save action data message
                    $this->action_data['action_log_message']="Try login by user login id : ".$this->input->post('username')." And password:".$this->input->post('password');
                    $this->action_data['action_functionality']='login';
                    $this->saveActionLog('login_model'); 
                    $this->session->set_userdata('LOGINMSG','Mismatch username and Password');
                    redirect('login');
                 }
            }
        }else
        {
            redirect('login', 'refresh');
        }
    }

    /**
     * Login ajax
     *
     * @param username (request data)
     * @param password (request data)
     *
     * @return response data where user is valid or not (json data)
     */
    public function _truecarLoginChecklogin() {
        // get ajax post data
        $responsedata=[];
        try{
                      
            if ($this->input->post('username')=='' || $this->input->post('password')=='') {
                throw new Exception("bad request",400);
            }  
            if($this->input->post('loginremenberme')==1)
            {
                
                $this->input->set_cookie('username',$this->input->post('username'),'86400*30',base_url().'login'); 
                $this->input->set_cookie('password',$this->input->post('password'),'86400*30',base_url().'login'); 
            }
            
            // load login model
            $this->load->model('Loginmodel','login_model',true);            
            // user check login by accessing model            
            if ($this->login_model->checkLogin()) {               
                $this->body_data['data_resource']=$this->login_model->data_resource?$this->login_model->data_resource->row():FALSE;
                
                //check the user status
                if($this->body_data['data_resource']->user_status=='1' || $this->body_data['data_resource']->user_status=='2')
                {
                    if($this->body_data['data_resource']->reset_password=='Y')
                    {
                        $responsedata=['responsecode'=>'200RPY','responsemessage'=>'Please contact admin for reset your password','responsedata'=>[]];
                    }else{
                        //match the password
                        $method=$this->body_data['data_resource']->hasing_method;
                        if($this->body_data['data_resource']->login_password==$method($this->body_data['data_resource']->saltcode.$this->input->post('password')))
                        {
                            $this->body_data['data_resource']=$this->login_model->getUserDetails($this->body_data['data_resource']->user_uuid)?$this->login_model->data_resource->row():FALSE;
                            if($this->body_data['data_resource'])
                            {
                                // set session data to use after otp enter 
                                $this->setSessionData();    
                                $responsedata=['responsecode'=>200,'responsemessage'=>'success','responsedata'=>['UUID'=>$this->body_data['data_resource']->user_uuid,'redirecturl'=>($this->session->userdata('REDIRECT_URL').'dashboard') ]];
                            }else{
                                //technical error
                                $responsedata=['responsecode'=>'200TECHER','responsemessage'=>'Technical error occurs','responsedata'=>[]];
                            }
                           
                        }else{
                            //userid and password mismatch
                            $responsedata=['responsecode'=>'200MIS','responsemessage'=>'Credential Mismatch','responsedata'=>[]];
                        }
                        
                    }
                }else if($this->body_data['data_resource']->user_status==0)
                {
                    //Inactive status
                    $responsedata=['responsecode'=>2000,'responsemessage'=>'Your account has been inactive','responsedata'=>[]];
                }
//                else if($this->body_data['data_resource']->user_status==2)
//                {
//                    //temporary block
//                    $responsedata=['responsecode'=>2002,'responsemessage'=>'Your account has been temprary block','responsedata'=>[]];
//                }
                else if($this->body_data['data_resource']->user_status==3)
                {
                    //deleted user
                    $responsedata=['responsecode'=>2003,'responsemessage'=>'Your account has been delete','responsedata'=>[]];
                }
            }else{
                 //userid and password mismatch
                $responsedata=['responsecode'=>'200NOTV','responsemessage'=>'You are not a valid user','responsedata'=>[]];
            }
        }catch(Exception $ex)
        {
            $responsedata=['responsecode'=>$ex->getCode(),'responsemessage'=>$ex->getMessage(),'responsedata'=>[]];
        }  finally {
         echo json_encode($responsedata);   
        }

    }
    private function setSessionData()
    {
        $this->session->set_userdata('ISLOGIN', TRUE);
        $this->session->set_userdata('USERUUID', $this->body_data['data_resource']->user_uuid);                                
        $this->session->set_userdata('LOGIN_ID', $this->body_data['data_resource']->login_id);
        $this->session->set_userdata('DISPLAY_NAME', $this->body_data['data_resource']->display_name);
        $this->session->set_userdata('USER_TYPE_ID', $this->body_data['data_resource']->id);
        $this->session->set_userdata('USER_TYPE_NAME', $this->body_data['data_resource']->user_type);
        $this->session->set_userdata('USER_STATUS', $this->body_data['data_resource']->user_status);
        $this->session->set_userdata('EMAIL_ID', $this->body_data['data_resource']->email_id);
        $this->session->set_userdata('USER_CODE', $this->body_data['data_resource']->user_code);
        $this->session->set_userdata('SHORT_CODE', $this->body_data['data_resource']->short_code);
        $this->session->set_userdata('REDIRECT_URL', $this->body_data['data_resource']->redirect_url);
        $this->session->set_userdata('FIRST_NAME', $this->body_data['data_resource']->first_name);
        $this->session->set_userdata('LAST_NAME', $this->body_data['data_resource']->last_name);
        $this->session->set_userdata('MIDDlE_NAME', $this->body_data['data_resource']->middle_name);
        $this->session->set_userdata('ADDRESS', $this->body_data['data_resource']->address);
        $this->session->set_userdata('STATE', $this->body_data['data_resource']->state);
        $this->session->set_userdata('CITY', $this->body_data['data_resource']->city);
        $this->session->set_userdata('COUNTRY', $this->body_data['data_resource']->country);
        $this->session->set_userdata('PINCODE', $this->body_data['data_resource']->pincode);
        $this->session->set_userdata('CONTACT_NO', $this->body_data['data_resource']->contact_no);
        $this->session->set_userdata('LOGINFROM', date('h:i A'));
        
    }
    /**
     * OTP check ajax after login
     *
     * @param otp (request data)
     *
     * @return (string) success
     */
    public function _truecarLoginOtpcheck() {
        // get ajax post data
        if (!$this->input->post('otp')) {
            throw new Exception("Request data not found",404);
        }

        // check intput otp with session otp
        if (isset($this->session->userdata['otp'])
            && $this->session->userdata['otp'] == $this->input->post('otp')
            && isset($this->session->userdata['user_uuid'])) {

            // get user details from login model and set user details into session
            $this->load->model('Loginmodel');
            if ($this->Loginmodel->getUserDetails($this->session->userdata['user_uuid'])) {

                // set session data
                $this->session->set_userdata('ISLOGIN', TRUE);
                $this->session->set_userdata('LOGIN_ID', $this->Loginmodel->data_resource->row()->login_id);
                $this->session->set_userdata('DISPLAY_NAME', $this->Loginmodel->data_resource->row()->display_name);
                $this->session->set_userdata('USER_TYPE_ID', $this->Loginmodel->data_resource->row()->id);
                $this->session->set_userdata('USER_TYPE_NAME', $this->Loginmodel->data_resource->row()->user_type);
                $this->session->set_userdata('EMAIL_ID', $this->Loginmodel->data_resource->row()->email_id);
                $this->session->set_userdata('USER_CODE', $this->Loginmodel->data_resource->row()->user_code);
                $this->session->set_userdata('SHORT_CODE', $this->Loginmodel->data_resource->row()->short_code);
                $this->session->set_userdata('REDIRECT_URL', $this->Loginmodel->data_resource->row()->redirect_url);
                $this->session->set_userdata('FIRST_NAME', $this->Loginmodel->data_resource->row()->first_name);
                $this->session->set_userdata('LAST_NAME', $this->Loginmodel->data_resource->row()->last_name);
                $this->session->set_userdata('MIDDlE_NAME', $this->Loginmodel->data_resource->row()->middle_name);
                $this->session->set_userdata('ADDRESS', $this->Loginmodel->data_resource->row()->address);
                $this->session->set_userdata('STATE', $this->Loginmodel->data_resource->row()->state);
                $this->session->set_userdata('CITY', $this->Loginmodel->data_resource->row()->city);
                $this->session->set_userdata('COUNTRY', $this->Loginmodel->data_resource->row()->country);
                $this->session->set_userdata('PINCODE', $this->Loginmodel->data_resource->row()->pincode);
                $this->session->set_userdata('CONTACT_NO', $this->Loginmodel->data_resource->row()->contact_no);

                // unset previous session data which is inserted before entering otp
                $this->session->unset_userdata['user_uuid'];
                $this->session->unset_userdata['otp'];

                echo 'success';
            }
        }
    }

    /**
     * Logout and unset session datA
     */
    public function _truecarLoginLogout() {
        $this->session->sess_destroy();
        redirect('login','location');
    }
    /*
     *Generate otp for login 
     * @param : Null
     * 
     * @return : otp code
     *  
     */
    private function generateOTP()
    {
        return random_string('number',4);
    }
    /*
     *send otp to email address and sms
     * @param : Null
     * 
     * @return : otp code
     *  
     */
    private function sendMailSMSOtp($protocaltype='sendmail')
    {
        $status=FALSE;
        try {
            switch($protocaltype)
            {
                case 'smtp':
                            $this->load->library('email',['protocol' => 'smtp',
                                                          'smtp_host'=>$this->config->item('smtp_host'),
                                                          'smtp_port'=>$this->config->item('smtp_port'),
                                                          'smtp_user'=>$this->config->item('smtp_user'),
                                                          'smtp_pass'=>$this->config->item('smtp_pass'),
                                                          'mailtype' => 'html',
                                                          'charset' => 'iso-8859-1',
                                                          'wordwrap' => TRUE]);
                            break;
                case 'sendmail':
                        $this->load->library('email',['protocol' => 'sendmail','mailtype' => 'html','charset' => 'iso-8859-1','wordwrap' => TRUE]);
                        break;
                default:
                        $this->load->library('email',['protocol' => 'sendmail','mailtype' => 'html','charset' => 'iso-8859-1','wordwrap' => TRUE]);
                        break;
            }
            $this->email->from($this->config->item('fromEmail'), 'Rationing System');
            $this->email->to($this->body_data['data_resource']->email_id);
            $this->email->subject('Otp to access rationing system');
            $tempdata=$this->load->view('emailtemplate/otp','',TRUE);
            $tempdata=  str_replace(array('OTP'), array($this->otp), $tempdata);
            $this->email->message($tempdata);
            if($this->email->send())
                $status=TRUE;
            else
                $status=FALSE;
            
        } catch (Exception $ex) {
            $status=FALSE;
        }  finally {
        return $status;    
        }
    }
    public function _truecarLoginforgotpassword()
    {
        echo 'development under process';
    }
}
