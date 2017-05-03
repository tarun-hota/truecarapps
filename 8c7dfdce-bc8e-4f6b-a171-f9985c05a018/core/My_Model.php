<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of My_Model
 *
 * @author Ganadeb
 */
class My_Model extends CI_Model{
    public $data_resource;
    public $num_of_rows;
    public $num_of_affected_rows;
    public function __construct() {
        parent::__construct();
        $this->data_resource=FALSE;
        $this->num_of_affected_rows=0;
        $this->num_of_rows=0;
    }
    protected function generateUUID() 
    {
        return $this->isValidUUID(sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

                // 16 bits for "time_mid"
                mt_rand( 0, 0xffff ),

                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand( 0, 0x0fff ) | 0x4000,

                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand( 0, 0x3fff ) | 0x8000,

                // 48 bits for "node"
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            ));
    }
    protected function isValidUUID($uuid)
    {
        return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
              '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1?$uuid:$this->generateUUID();
    }
    protected function escape($data)
    {
        return mysqli_escape_string($this->db->conn_id, $data);
    }
    public function saveActionLog($data=array())
    {
        try {
            if(count($data)>0)
            {
                foreach($data as $key=>$val)
                {
                    $this->db->set($key,$this->escape($val));
                }
                $this->db->insert(ACTIONLOG);
            }  else {
                throw new Exception('Unwanted error occurs. Try after some time or contact site manager',4015);
            }
        } catch (Exception $ex) {
            die(json_encode(array('errorcode'=>$ex->getCode(),'message'=>$ex->getMessage())));
        }
    }
}
