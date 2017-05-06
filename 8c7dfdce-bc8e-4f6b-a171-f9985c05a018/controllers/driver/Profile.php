<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profile
 *
 * @author Ganadeb
 */
class Profile extends My_Controller{
    public function __construct(){
        parent::__construct();
        $this->extra_data['active_menu']='profile';
        parent::checkAuthentication(2,'DV');
        $this->load->model('userprofile','user_profile',FALSE);
    }
    public function _remap($method='index')
    {
        try {
            if(method_exists($this, '_truecarProfile'.ucfirst($method)))
            {
                $this->{"_truecarProfile".ucfirst($method)}();
            }  else {
                throw new Exception("Page Not Found",404);
            }
        } catch (Exception $ex) {
            show_404();
        }
        
    }
    public function _truecarProfileIndex(){
        if($this->session->userdata('USERUUID')==NULL)
            redirect('login/logout','location');
        $this->header_data['title']='True Car | Driver Profile'; 
        $this->body_data['user_profile']=$this->user_profile->getUserDetails($this->session->userdata('USERUUID'))?$this->user_profile->data_resource->row():FALSE;
        $this->body_data['driver_truckinfo']=$this->user_profile->getTruckInfo($this->session->userdata('USERUUID'))?$this->user_profile->data_resource->row():FALSE;
        
        $this->template('driver/templates/profile', FALSE);        
    }
     public function _truecarProfileCreate(){
         
     }
}
