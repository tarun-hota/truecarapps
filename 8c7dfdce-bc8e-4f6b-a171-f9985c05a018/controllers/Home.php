<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Ganadeb
 */
class Home extends My_Controller {
     public function __construct(){
        parent::__construct();
        $this->load->model('Home_model','home_model',FALSE);
    }
    public function _remap($method='index')
    {
        try {
            if(method_exists($this, '_truecarHome'.ucfirst($method)))
            {
                $this->{"_truecarHome".ucfirst($method)}();
            }  else {
                throw new Exception("Page Not Found",404);
            }
        } catch (Exception $ex) {
            show_404();
        }
        
    }
    public function _truecarHomeIndex()
    {
        $this->load->model('home_model','homemodel',FALSE);
        $this->header_data['title']="True Car Apps | Home";
        $this->body_data['siteinfo']=$this->homemodel->getSiteSettingData()?$this->homemodel->data_resource->row():FALSE;
        $this->load->view('front/home',  array_merge($this->body_data,$this->header_data),FALSE);
    }
    public function _truecarHomeRegistration()
    {
        $response=[];                
        try {
            //check email address            
            if(!$this->home_model->checkEmail($this->input->post('email')))
            {
               //save the registration data 
               if($uuid=$this->home_model->saveRagistrationData())
               {
                   //send to activation mail
                   $this->sendActivationMail('sendmail',$uuid);
                   $response=['responsecode'=>200,'responsemessage'=>"You are successfully register.We are sent a activation link to your email address.To access the profile Please active your account "];   
               }else{
                   $response=['responsecode'=>2004,'responsemessage'=>"Technical Problem.Please contact site admin"];   
               }
            }else{
                $response=['responsecode'=>2005,'responsemessage'=>"Email address already exists"];  
            }
        } catch (Exception $ex) {
            $response=['responsecode'=>400,'responsemessage'=>"Bad request"];
        }finally{
            echo json_encode($response);
        }
    }
    
    private function sendActivationMail($protocaltype='sendmail',$uuid=null)
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
            $this->email->from($this->config->item('fromEmail'), 'True Car Apps');
            $this->email->to($this->input->post('email'));
            $this->email->subject('True Car apps activation mail');
            $tempdata=$this->load->view('emailtemplate/activation','',TRUE);
            $tempdata=  str_replace(array('FULLNAME','VERIFYCODE'), array(ucfirst($this->input->post('firstname')),base_url().'home/activation/'.base64_encode($uuid)), $tempdata);
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
    public function _truecarHomeActivation()
    {
        try {
            $uuid=  base64_decode($this->uri->segment(3));
            if($this->home_model->activation($uuid))
            {
                $this->body_data['success']=TRUE;                
            }  else {
                $this->body_data['success']=FALSE;
            }
        } catch (Exception $ex) {
            die('{"error":"403","message":"Bad request"}');
        }finally{
            $this->header_data['title']="True Car Apps | Home Activation Process";
            $this->body_data['siteinfo']=$this->home_model->getSiteSettingData()?$this->home_model->data_resource->row():FALSE;
            $this->load->view('front/activationsuccess',  array_merge($this->body_data,$this->header_data),FALSE);
        }
    }
    //contact us functionality
    public function _truecarHomeContuctus()
    {
        
        $response=[];$protocaltype='sendmail';
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
            $this->email->from('contact@bindasstech.com', 'True Car Apps');
            $this->email->to($this->config->item('fromEmail'));
            $this->email->reply_to($this->input->post('email'));
            $this->email->subject('True Car apps | '.  ucwords($this->input->post('fullname').' wants to contact with you '));
            $tempdata=$this->load->view('emailtemplate/contactus','',TRUE);
            $tempdata=  str_replace(array('FULLNAME','EMAIL','LOCATION','PHONENO','MESSAGE'), array(ucwords($this->input->post('fullname')),$this->input->post('email'),$this->input->post('conlocation'),$this->input->post('phoneno'),$this->input->post('conmessage')), $tempdata);
            $this->email->message($tempdata);
            if($this->email->send())
                $response=['responsecode'=>200,'responsemessage'=>"Thank you for your response.We reach at you as soon as posible"];
            else
                $response=['responsecode'=>200,'responsemessage'=>"Technical problem. Try after some time"];
            
        } catch (Exception $ex) {
            $response=['responsecode'=>403,'responsemessage'=>"Technical problem.Try after some time"];
        }  finally {
        echo json_encode($response);    
        }
    }
}
