<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Userprofile
 *
 * @author Ganadeb
 */
class Userprofile extends My_Model{
    public function __construct() {
        parent::__construct();
    }
    public function getTruckInfo($uuid=NULL)
    {
        $status=TRUE;
        try {
            $this->db->select('*')->from(DRIVERSTRUCKINFO)->where('driveruuid',$uuid);
            $this->data_resource=$this->db->get();
            if($this->data_resource->num_rows()>0)
                $sytatus=TRUE;
            
        } catch (Exception $ex) {
            $status=FALSE;
        }  finally {
            return $status;
        }
    }
    public function getUserDetails($user_uuid) {

        // query execution
        $this->db->select('*');
        $this->db->from(USER." U ");
        $this->db->join(USERTYPE." UT ", 'U.user_type=UT.id');
        $this->db->join(USERDETAILS." UD ", 'U.user_uuid=UD.umid');
        $this->db->where('U.user_uuid', $user_uuid);
        $this->data_resource = $this->db->get();
        if ($this->data_resource->num_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }
    public function saveProfileData()
    {
        
    }
}
