<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('googlemaps');
    }
 
	public function index()
	{

		$config['center'] =  'Cambodia';        
        $config['zoom'] = 7;
        $config['places'] = TRUE;
        $config['sensor'] = FALSE;
        $config['apikey'] = 'AIzaSyDKrPtf6JLgV2WTKchsK4SEY7q38sFRD5Y';
        $this->googlemaps->initialize($config);

        $marker = array();  
        $marker['position'] = '11.5448729, 104.8921668';
        $marker['infowindow_content'] = '<div class="row">';
        $marker['infowindow_content'] .= '<div class="col-xs-4">';
        $marker['infowindow_content'] .= ''.img('assets/images/thumbs/IMG-019.jpg').'';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '<div class="col-xs-7">';
        $marker['infowindow_content'] .= '<h5 class="text-warning">Ms. PHORS</h5>';
        $marker['infowindow_content'] .= '<p class="text-info">The GPS coordinates <br />and the longitude  and latitude of Phnom Penh.</p>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';   
          $marker['animation'] = 'DROP';      
        $this->googlemaps->add_marker($marker); 
      
        $data['map'] = $this->googlemaps->create_map();
        $data['main_title'] = 'Statistics Collection';
		$data['template'] ='index';
		$this->load->view('includes/template', $data);
	}

    public function index()
    {

        $config['center'] =  'Cambodia';        
        $config['zoom'] = 7;
        $config['places'] = TRUE;
        $config['sensor'] = FALSE;
        $config['apikey'] = 'AIzaSyDKrPtf6JLgV2WTKchsK4SEY7q38sFRD5Y';
        $this->googlemaps->initialize($config);

        $marker = array();  
        $marker['position'] = '11.5448729, 104.8921668';
        $marker['infowindow_content'] = '<div class="row">';
        $marker['infowindow_content'] .= '<div class="col-xs-4">';
        $marker['infowindow_content'] .= ''.img('assets/images/thumbs/IMG-019.jpg').'';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '<div class="col-xs-7">';
        $marker['infowindow_content'] .= '<h5 class="text-warning">Ms. PHORS</h5>';
        $marker['infowindow_content'] .= '<p class="text-info">The GPS coordinates <br />and the longitude  and latitude of Phnom Penh.</p>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';   
          $marker['animation'] = 'DROP';      
        $this->googlemaps->add_marker($marker); 
      
        $data['map'] = $this->googlemaps->create_map();
        $data['main_title'] = 'Statistics Collection';
        $data['template'] ='index';
        $this->load->view('includes/template', $data);
    }

    public function  error_404(){

        $data['main_title'] = 'Error 404';
        $data['template'] ='error_404';
        $this->load->view('includes/template', $data);

    }

}
