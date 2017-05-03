<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_model
 *
 * @author Ganadeb
 */
class Login_model extends CI_Model{
    public function __construct() {        
        parent::__construct();
    }
    public function checkLoginData()
    {        
        $this->db->select(' * ')->from(USER);
        $this->db->where('loginid', $this->escape($this->input->post('username')));
        $this->db->where('loginpassword',md5($this->input->post('password')));
        $this->data_resource=$this->db->get();
        if($this->data_resource->num_rows()>0)
        {
            return TRUE;
        }
        return FALSE;
    }
    public function fetchUserData($uid=0,$typeid=0)
    {        
        if((int)$uid>0 && (int)$typeid>0)
        {            
            $this->db->select('U.*,UT.*,UD.user_full_name,UD.user_email,UD.user_contact_no,UD.gender,UD.user_profile_pic')->from(USER." U");
            $this->db->join(USERTYPE.' UT',"U.user_type = UT.utid" ); 
            $this->db->join(USERDETAILS.' UD','UD.user_master_id = U.userid');
            $this->db->where('U.userid =',$uid);
            $this->db->where('UT.utid = ',$typeid);            
            $this->data_resource=$this->db->get();
            if($this->data_resource->num_rows()>0)
            {
                return TRUE;
            }
            return FALSE;
        }
        return FALSE;
    }
}
