<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends CI_Controller {

	function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('setting/address_model', 'addr');
        $this->load->library('googlemaps');
        $this->load->model('map_model', 'maps');

    }
 
	public function index($id = null)
	{
 
        $data['main_title'] = 'Records- Districts';
        $data['query'] = $this->addr->rquery($id, 'tu_district', null);
		$data['template'] ='district/index';
		$this->load->view('setting/includes/template', $data);
	}

    public function edit($id = null)
    {
       
        $this->form_validation->set_rules('distr_nu_latitude', 'Latitude', 'trim|required');
        $this->form_validation->set_rules('distr_nu_longitude', 'Longitude', 'trim|required');
        
        
        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
          
            $data['main_title'] = 'Edit';
            $data['query'] = $this->addr->rquery($id, 'tu_district', 'distr_id');
            $data['template'] ='district/edit';
            $this->load->view('setting/includes/template', $data);

        }
        else
        {
        
            $data = array(
            'distr_nu_latitude' => $this->input->post('distr_nu_latitude'),
            'distr_nu_longitude' => $this->input->post('distr_nu_longitude')
            );

            
            // saved form data into database
            if ($this->addr->modify('tu_district', $data, 'distr_id'))
            {
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully saved!  </div>');
                redirect('setting/district/edit/' . $this->input->post('id') );
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('setting/district/edit/' . $this->input->post('id') );
            }
        }
        
       
    }

    public function prvin()
    {
 
        $query = $this->db->get_where('tu_district', array('prvin_id' => $this->input->post('prvin_id')))->result();

        if(count($query)){
            
            foreach($query as $row){

                $str = '<tr>';
                $str .= '<td>' .$row->distr_id. '</td>';
                $str .= '<td>' .$row->distr_desc_en. '</td>';
                $str .= '<td>' .$row->distr_nu_latitude. '</td>';
                $str .= '<td>' .$row->distr_nu_longitude. '</td>'; 
                 $str .= '<td>' . anchor('setting/district/track/' .$row->distr_id , 'track'). '</td>';
                $str .= '<td>' . anchor('setting/district/edit/' .$row->distr_id , 'Edit'). '</td>';
                echo $str.= '</tr>';

            }     

        }
    
    }


    public function track($id = null )
    {

        $config['center'] = '11.562108,104.888535'; 
        $config['zoom'] = 7;
        $config['apikey'] = 'AIzaSyDKrPtf6JLgV2WTKchsK4SEY7q38sFRD5Y';
        $this->googlemaps->initialize($config);

        $marker = array();
        $marker['position'] = '11.562108,104.888535';
        $marker['draggable'] = true;
        $marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
        $this->googlemaps->add_marker($marker);
 
        $data['map'] = $this->googlemaps->create_map();
        $data['main_title'] = 'Statistics Collection';
        $data['id'] = $id;
        $data['query'] = $this->addr->rquery($id, 'tu_district', 'distr_id');
        $data['template'] ='district/search';
        $this->load->view('setting/includes/template', $data);
    }
 
    
    
}//end class