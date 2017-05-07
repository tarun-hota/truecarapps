<?php
/**
 * Created by PhpStorm.
 * User: Tarun
 * Date: 5/6/2017
 * Time: 1:11 AM
 */

class Route_model extends My_Model{
    public function __construct() {
        parent::__construct();
    }

    /**
     * Save route data
     *
     * @param : ajax post request data
     *
     * @return : boolean
     */
    public function saveRouteData() {
        $this->db->trans_start();
        $first_insert_id = 0;
        if ($this->input->post('data') && !empty($this->input->post('data'))) {
            $address_data = $this->input->post('data');
            $counter = 1;
            foreach ($address_data as $address) {

                // make data from post request to insert into table
                $data = [
                    'driveruuid' => $this->session->userdata('USERUUID'),
                    'sourcedrop_point' => $address['address'],
                    'sourcedrop_lat' => $address['latitude'],
                    'sourcedrop_lang' => $address['longitude'],
                    'sourcedrop_date' => ($counter == 1 ? $this->input->post('date_of_journey') : ''),
                    'sourcedrop_parent_id' => $first_insert_id,
                ];

                $this->db->insert(DRIVERROUTE, $data);
                $first_insert_id = $counter == 1 ? $this->db->insert_id() : $first_insert_id;
                $counter++;
            }
        }

        // commit transaction or rollback
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    /**
     * Get all routes data
     *
     * @return boolean
     */
    public function getAllRoutes() {
        $this->db->select('*')->from(DRIVERROUTE);
        $this->db->where('driveruuid', $this->session->userdata('USERUUID'));
        $this->data_resource=$this->db->get();
        if ($this->data_resource->num_rows() > 0) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Delete a route
     *
     * @return boolean
     */
    public function deleteRoute() {
        $this->db->where('driver_routesid', $this->input->post('routes_id'));
        $this->db->or_where('sourcedrop_parent_id', $this->input->post('routes_id'));
        $this->db->delete(DRIVERROUTE);
        return $this->db->affected_rows();
    }

    /**
     * Change route status to enable or disable
     *
     * @return boolean
     */
    public function changeRouteStaus() {
        $status = $this->input->post('status') == 1 ? '0' : '1';
        $this->db->where('driver_routesid', $this->input->post('routes_id'));
        $this->db->or_where('sourcedrop_parent_id', $this->input->post('routes_id'));
        $this->db->update(DRIVERROUTE, array('sourcedrop_status' => $status));
        return $this->db->affected_rows();
    }
}

?>