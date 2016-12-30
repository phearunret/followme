<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('googlemaps');
        $this->load->model('map_model', 'maps');
    }
 
	public function index()
	{

		$config['center'] = "11.562108, 104.888535";        
        $config['zoom'] = 7;
        $config['places'] = TRUE;
        $config['sensor'] = FALSE;
        $config['apikey'] = 'AIzaSyDKrPtf6JLgV2WTKchsK4SEY7q38sFRD5Y';
        $config['map_height'] = '100%'; 
    

        $this->googlemaps->initialize($config);

        $overdue_in_days = array( 1 => 30, 30 => 60, 60 => 90 );

        foreach ( $overdue_in_days as $start => $off ) {

            $coords = $this->maps->Qoverdue( $start, $off );
            if(count( $coords )){
            
                foreach ($coords as $coordinate) { 
                
                    $marker = array();
                    $marker['icon'] = base_url('assets/images/icons/overdue_in_'.$off.'.png');

                    $marker['position'] = $coordinate->commu_nu_latitude.','. $coordinate->commu_nu_longitude; 
                    $marker['infowindow_content'] =  anchor('maps/coon_id/'. $coordinate->commu_id, '<b>Number Overude in '. $off . ' days'.  ' (' .$coordinate->overdue .')' .'</b>', array('class'=>'text-info'));

                    $address = '<p class="text-info" style="padding: 5px 0;">';
                    $address .=  $coordinate->distr_desc_en .' District,' .$coordinate->commu_desc_en .' Commune,' . $coordinate->prvin_desc_en . ' Province' ;
                    $address .= '</p>';
                   
                    $marker['infowindow_content'] .= $address;
                    $marker['draggable'] = true;
                    $marker['animation'] = 'DROP';        
                    $this->googlemaps->add_marker($marker);   

                }

            }  
             
        }

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



