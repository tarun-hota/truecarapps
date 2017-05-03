<?php
/**
 * Model of login
 *
 * @author Tarun
 */
class Loginmodel extends My_Model {
    public function __construct()
    {
        parent::__construct();       
    }

    /**
     * Get user data and check login
     *
     * @param username
     * @param password
     *
     * @return boolean
     */
    public function checkLogin() {       
        // query execution
        $this->db->select('user_uuid,login_id,login_password,is_forgot_password,reset_password,user_status,saltcode,hasing_method,user_code');
        $this->db->from(USER);
        $this->db->where('login_id', $this->input->post('username'));        
        $this->data_resource = $this->db->get();        
        if ($this->data_resource->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get user data by user_uuid after otp enter
     *
     * @param user_uuid
     *
     * @return boolean
     */
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

}
?>