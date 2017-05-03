<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author Ganadeb
 */
class Dashboard extends My_Controller{
    public function __construct(){
        parent::__construct();
        //checkAuthentication();
    }
    public function _remap($method='index')
    {
        try {
            if(method_exists($this, '_truecarDashboard'.ucfirst($method)))
            {
                $this->{"_truecarDashboard".ucfirst($method)}();
            }  else {
                throw new Exception("Page Not Found",404);
            }
        } catch (Exception $ex) {
            show_404();
        }
        
    }
    public function _truecarDashboardIndex(){
        $this->header_data['title']='True Car | Driver Dashboard';
        $this->header_data['session_data'] = $this->session->userdata();        
        $this->template('distributor/templates/dashboard', FALSE);        
    }
}
