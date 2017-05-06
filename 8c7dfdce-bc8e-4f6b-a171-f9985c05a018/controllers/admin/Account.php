<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account
 *
 * @author Ganadeb
 */
class Account extends My_Controller{
    public function __construct(){
        parent::__construct();
        parent::checkAuthentication(1,'SA');
        $this->extra_data['active_menu']='account';
    }
    public function _remap($method='index')
    {
        try {
            if(method_exists($this, '_truecarAccount'.ucfirst($method)))
            {
                $this->{"_truecarAccount".ucfirst($method)}();
            }  else {
                throw new Exception("Page Not Found",404);
            }
        } catch (Exception $ex) {
            show_404();
        }
        
    }
    public function _truecarAccountIndex(){
        $this->header_data['title']='True Car | Driver Account';                
        $this->template('admin/templates/account', FALSE);        
    }
}
