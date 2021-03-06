<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Controller
 *
 * @author Ganadeb
 */
class My_Controller extends CI_Controller{
    public $header_data;
    public $body_data;
    public $footer_data;
    public $extra_data;
    public $dataerror;
    public $resource_per_data;
    public $action_data;
    public $seo_data;
    public static $base;
    public $flag;
    function __construct() {       
        parent::__construct();
        $this->header_data=array();
        $this->body_data=array();
        $this->footer_data=array();
        $this->extra_data=array();
        $this->dataerror=array();
        $this->seo_data=[];
        self:: $base=&get_instance();
        $this->flag=FALSE;
        if($this->session->userdata('ISLOGIN')=='')
        {
            $this->session->set_userdata('ISLOGIN',FALSE);
        }
        $this->action_data=array('action_functionality'=>'WithoutLogin','log_data '=>'','logtime'=>date('Y-m-d H:i:s P'),'from_ip'=>$this->input->ip_address());
    }
    protected function saveActionLog($model='My_model')
    {
        try {
            if($model==NULL || $model=='')
            {
                throw new Exception('Some unqanted error occurs', 4015);
            }
            $this->{$model}->saveActionLog($this->action_data);
        } catch (Exception $ex) {
            die(json_encode(array('errorcode'=>$ex->getCode(),'message'=>$ex->getMessage())));
        }
        
    }
    protected function checkAuthentication($usertype=NULL,$shortcode=NULL)
    {
        try {
            if($usertype==NULL || empty($usertype) || $shortcode==NULL || empty($shortcode) )
                throw new Exception("You are trying unauthorise access",403);
            else if(($this->session->userdata('USER_TYPE_ID')!=$usertype && $this->session->userdata('SHORT_CODE')!= $shortcode) && ($this->session->userdata('USER_TYPE_ID')!='' && $this->session->userdata('SHORT_CODE')!='')){
                redirect(base_url().$this->session->userdata('REDIRECT_URL').'dashboard');
            }else if($this->session->userdata('USER_TYPE_ID')=='' || $this->session->userdata('SHORT_CODE')=='')
            {
                redirect('login','location');
            }else if(($this->session->userdata('USER_TYPE_ID')!=$usertype && $this->session->userdata('SHORT_CODE')!= $shortcode)) 
            {
                redirect(base_url().$this->session->userdata('REDIRECT_URL').'dashboard');
            }
            else {
                return;
            }
        } catch (Exception $ex) {
            die('<h2>'.$ex->getCode().' : '.$ex->getMessage().'</h2>');
        }
    }
    protected function template($page='',$flag=FALSE)
    {
        try {
            if($page=='' || !is_string($page))
            {
                throw new Exception("Error404:Page Not Found");            
            }  
            if($flag)
            {
                $data=$this->load->view('templates/header',array_merge($this->header_data,$this->seo_data),$flag);
                $data.=$this->load->view('templates/leftpanel',$this->extra_data,$flag);
                $data.=$this->load->view($page,  $this->body_data,$flag);
                $data.=$this->load->view('templates/footer',$this->footer_data,$flag); 
                echo $data;exit;
            }else
            {
                $this->load->view('templates/header',array_merge($this->header_data,$this->seo_data),$flag);
                $this->load->view('templates/leftpanel',$this->extra_data,$flag);
                $this->load->view($page,$this->body_data,$flag);
                $this->load->view('templates/footer',$this->footer_data,$flag); 
            }
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
    }
}
