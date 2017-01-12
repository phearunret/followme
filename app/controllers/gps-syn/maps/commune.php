<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commune extends Gps_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('gps-syn/maps/address_model', 'addr');
        $this->load->library('googlemaps');
        $this->load->model('map_model', 'maps');
        $this->load->library('pagination');


    }

    public function index($id = null)
    {

        $data['main_title'] = 'Communes';
        $data['query'] = $this->addr->rquery($id, 'tu_commune', null);
        $data['template'] = 'maps/commune/index';
        $this->load->view('gps-syn/includes/template', $data);
    }

    public function edit($id = null)
    {

        $this->form_validation->set_rules('commu_nu_latitude', 'Latitude', 'trim|required');
        $this->form_validation->set_rules('commu_nu_longitude', 'Longitude', 'trim|required');


        //validate form input
        if ($this->form_validation->run() == FALSE) {

            $data['main_title'] = 'Commune';
            $data['query'] = $this->addr->rquery($id, 'tu_commune', 'commu_id');
            //echo $this->db->last_query();
            $data['template'] = 'maps/commune/edit';
            $this->load->view('gps-syn/includes/template', $data);

        } else {

            $data = array(
                'commu_nu_latitude' => $this->input->post('commu_nu_latitude'),
                'commu_nu_longitude' => $this->input->post('commu_nu_longitude')
            );


            // saved form data into database
            if ($this->addr->modify('tu_commune', $data, 'commu_id')) {
                //echo $this->db->last_query();
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">You are Successfully saved!  </div>');
                redirect('gps-syn/maps/commune/edit/' . $this->input->post('id'));
            } else {
                // error
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('gps-syn/maps/commune/edit/' . $this->input->post('id'));
            }
        }


    }

    public function distr()
    {

        $query = $this->db->get_where('tu_district', array('prvin_id' => $this->input->post('prvin_id')))->result();

        if (count($query)) {

            $str = '<option value="0"> [Select Districts] </option>';

            foreach ($query as $row) {

                $str .= '<option value ="' . $row->distr_id . '">';
                $str .= $row->distr_desc_en;
                $str .= '</option>';

            }

            echo $str;

        }

    }

    public function distr_id()
    {


        $query = $this->db->get_where('tu_commune', array('distr_id' => $this->input->post('distr_id')))->result();

        if (count($query)) {

            foreach ($query as $row) {

                $str = '<tr>';
                $str .= '<td>' . $row->commu_id . '</td>';
                $str .= '<td>' . $row->commu_desc_en . '</td>';
                $str .= '<td>' . $row->commu_nu_latitude . '</td>';
                $str .= '<td>' . $row->commu_nu_longitude . '</td>';
                $str .= '<td>' . anchor('gps-syn/maps/commune/track/' . $row->commu_id, 'Track') . '</td>';
                $str .= '<td>' . anchor('gps-syn/maps/commune/edit/' . $row->commu_id, '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>') . '</td>';
                echo $str .= '</tr>';

            }

        }

    }

    public function track($id = null)
    {

        $config['center'] = '11.562108,104.888535';
        $config['zoom'] = 7;
        $config['apikey'] = 'AIzaSyDKrPtf6JLgV2WTKchsK4SEY7q38sFRD5Y';
        $this->googlemaps->initialize($config);
        $coordinate = $this->addr->rquery($id, 'tu_commune', 'commu_id');
        $marker = array();
        $marker['position'] = (is_null($coordinate->commu_nu_latitude) ? '11.562108' : $coordinate->commu_nu_latitude) . ',' . (is_null($coordinate->commu_nu_longitude) ? '104.888535' : $coordinate->commu_nu_longitude);
        $marker['draggable'] = true;
        $marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
        $this->googlemaps->add_marker($marker);

        $data['map'] = $this->googlemaps->create_map();
        $data['main_title'] = 'Commune';
        $data['id'] = $id;
        $data['query'] = $this->addr->rquery($id, 'tu_commune', 'commu_id');
        $data['template'] = 'maps/commune/search';
        $this->load->view('gps-syn/includes/template', $data);
    }


}//end class
