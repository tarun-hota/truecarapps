<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home_model
 *
 * @author Ganadeb
 */
class Home_model extends My_Model{
    public function __construct() {
        parent::__construct();
    }
    public function getSiteSettingData()
    {
        $status=FALSE;
        try {
            $this->db->select('*')->from(SITEDETAILS);
            $this->data_resource=$this->db->get();
            if($this->data_resource->num_rows()>0)
                $status=TRUE;
            
        } catch (Exception $ex) {
            
        }  finally {
            return $status;
        }
    }
    public function checkEmail($email=NULL)
    {
        $status=FALSE;
        try {
            if($email==NULL)
                throw new Exception("false");
            $this->db->select('login_id,email_id')->from(USER)->where('login_id',$email)->or_where('email_id',$email);
            $this->data_resource=$this->db->get();            
            if($this->data_resource->num_rows()>0)
                $status=TRUE;
        } catch (Exception $ex) {
            $status=TRUE;
        }  finally {
            return $status;
        }
    }
    public function saveRagistrationData()
    {
        $status=FALSE;
        try {
            $uuid=$this->generateUUID(); 
            $slatcode=random_string('alnum',10);
            $this->db->set('login_id',$this->input->post('email'));
            $this->db->set('email_id',$this->input->post('email'));
            $this->db->set('login_password',md5($slatcode.$this->input->post('password')));
            $this->db->set('user_uuid',$uuid);
            $this->db->set('is_forgot_password','0');
            $this->db->set('reset_password','N');
            $this->db->set('display_name','');
            $this->db->set('user_status','4');
            $this->db->set('user_type','2');
            $this->db->set('saltcode', $slatcode );
            $this->db->set('hasing_method ',  'md5');
            $this->db->set('user_code ',  random_string('alnum',10));
            $this->db->set('insert_time ',  date('Y-m-d h:i:s'));
            $this->db->set('update_time ',  date('Y-m-d h:i:s'));
            $this->db->set('last_update_by ',  $uuid);
            $this->db->insert(USER);
            if($this->db->affected_rows()>0)
            {
                //save user details
                $this->db->set('first_name',$this->input->post('firstname'));
                $this->db->set('last_name ',$this->input->post('lastname'));
                $this->db->set('middle_name ',$this->input->post('middlename'));
                $this->db->set('emailid ',$this->input->post('email'));
                $this->db->set('umid',$uuid);
                $this->db->set('user_details_uuid',$this->generateUUID());
                $this->db->set('address','');
                $this->db->set('state','');
                $this->db->set('city','');
                $this->db->set('country','');
                $this->db->set('pincode','');
                $this->db->set('contact_no   ','');
                $this->db->set('status','4');
                $this->db->insert(USERDETAILS);
                if($this->db->affected_rows()==0)
                {
                    $this->db->delete(USER)->where('user_uuid',$uuid);
                }
                $status=$uuid;
            }
            
        } catch (Exception $ex) {
            $status=FALSE;
        }  finally {
            return $status;
        }
    }
    public function activation($uuid=NULL)
    {
        try {
            $this->db->set('user_status','2');
            $this->db->where('user_uuid',$uuid);
            $this->db->update(USER);            
            if($this->db->affected_rows()>0)
            {
                $this->db->set('status','2');
                $this->db->where('umid',$uuid);
                $this->db->update(USERDETAILS);
                return TRUE;
            }
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
}
