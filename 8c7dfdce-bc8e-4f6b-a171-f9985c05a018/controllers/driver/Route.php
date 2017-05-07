<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of route
 *
 * @author Ganadeb
 */
class Route extends My_Controller{
    public function __construct(){
        parent::__construct();
        $this->extra_data['active_menu']='route';
        parent::checkAuthentication(2,'DV');
    }
    public function _remap($method='index')
    {
        try {
            if(method_exists($this, '_truecarRoute'.ucfirst($method)))
            {
                $this->{"_truecarRoute".ucfirst($method)}();
            }  else {
                throw new Exception("Page Not Found",404);
            }
        } catch (Exception $ex) {
            show_404();
        }
        
    }

    /**
     * Routes list and all ajax call related this view
     * It is default view of this controller
     *
     */
    public function _truecarRouteIndex(){

        if (!$this->input->is_ajax_request()) { // FOR NORMAL VIEW LOAD

            $this->header_data['title'] = 'True Car | Routes List';
            $this->header_data['session_data'] = $this->session->userdata();

            // get routes data from model
            $this->load->model('Route_model');
            $data = [];
            if ($this->Route_model->getAllRoutes()) {
                $result = $this->Route_model->data_resource->result();
                foreach ($result as $row) {
                    if ($row->sourcedrop_parent_id == 0) {
                        $data[$row->driver_routesid] = [
                            'id' => $row->driver_routesid,
                            'source_point' => $row->sourcedrop_point,
                            'status' => $row->sourcedrop_status,
                            'date_of_journey' => substr($row->sourcedrop_date, 0, 10),
                            'drop_points' => '',
                            'edit_delete_status' => (strtotime($row->sourcedrop_date) > strtotime(date('Y-m-d').' 00:00:00') ? 1 : 0)
                        ];
                    } else {
                        $data[$row->sourcedrop_parent_id]['drop_points'] = $data[$row->sourcedrop_parent_id]['drop_points'] == ''
                            ? $row->sourcedrop_point
                            : ($data[$row->sourcedrop_parent_id]['drop_points'] . ' / ' . $row->sourcedrop_point);
                    }
                }
            }

            $this->body_data['data'] = $data;
            $this->body_data['addroutesuccess'] = '';
            if ($this->session->userdata('addroutesuccess')) {
                $this->body_data['addroutesuccess'] = $this->session->userdata('addroutesuccess');
                $this->session->unset_userdata('addroutesuccess');
            }
            $this->template('driver/templates/routes_list', FALSE);

        } else { // FOR AJAX REQUEST

            // Load Route model
            $this->load->model('Route_model');

            if ($this->input->post('param') == 'delete_route') { // delete route

                try {
                    if (!$this->input->post('routes_id') || $this->input->post('routes_id') == '')
                        throw new Exception("bad request", 400);

                    if ($this->Route_model->deleteRoute()) {
                        echo 'success';
                    }

                } catch (Exception $e) {
                    echo $e->getCode() . ', ' . $e->getMessage();
                }

            } else { // change route status

                if ($this->Route_model->changeRouteStaus()) {
                    echo 'success';
                }
            }
        }
    }

    /**
     * Add route view and ajax call related this view
     *
     */
    public function _truecarRouteAdd(){
        if (!$this->input->is_ajax_request()) { // FOR NORMAL VIEW LOAD

            $this->header_data['title'] = 'True Car | Add Route';
            $this->header_data['session_data'] = $this->session->userdata();
            $this->template('driver/templates/add_route', FALSE);

        } else { // FOR AJAX REQUEST

            try {
                if (!$this->input->post('date_of_journey') || $this->input->post('date_of_journey') == '')
                    throw new Exception("bad request",400);

                // Load Route model to save data
                $this->load->model('Route_model');
                if ($this->Route_model->saveRouteData()) {
                    $this->session->set_userdata('addroutesuccess', 1);
                    echo 'success';
                }

            } catch (Exception $e) {
                echo $e->getCode().', '. $e->getMessage();
            }
        }
    }
}
