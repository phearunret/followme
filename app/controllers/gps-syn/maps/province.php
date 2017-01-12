<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province extends Gps_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('gps-syn/maps/address_model', 'addr');
    }

    public function index($id = null)
    {

        $data['main_title'] = 'Provinces';
        $data['query'] = $this->addr->rquery($id, 'tu_province', null);
        $data['template'] = 'maps/province/index';
        $this->load->view('gps-syn/includes/template', $data);
    }

    public function edit($id = null)
    {

        $this->form_validation->set_rules('prvin_nu_latitude', 'Latitude', 'trim|required');
        $this->form_validation->set_rules('prvin_nu_longitude', 'Longitude', 'trim|required');


        //validate form input
        if ($this->form_validation->run() == FALSE) {

            $data['main_title'] = 'Edit';
            $data['query'] = $this->addr->rquery($id, 'tu_province', 'prvin_id');
            $data['template'] = 'maps/province/edit';
            $this->load->view('gps-syn/includes/template', $data);

        } else {

            $data = array(
                'prvin_nu_latitude' => $this->input->post('prvin_nu_latitude'),
                'prvin_nu_longitude' => $this->input->post('prvin_nu_longitude')
            );


            // saved form data into database
            if ($this->addr->modify('tu_province', $data, 'prvin_id')) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">You are Successfully saved!  </div>');
                redirect('maps/province/edit/' . $this->input->post('id'));
            } else {
                // error
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('maps/province/edit/' . $this->input->post('id'));
            }
        }


    }


}//end class
