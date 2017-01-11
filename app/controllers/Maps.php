<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {
	function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('Map_model', 'map');
    }

    public function t(){
      $query = $this->db->select('commu_id,commu_nu_latitude, commu_nu_longitude')->get_where('tu_commune_new',array('commu_nu_latitude !=' => null))->result();

        if(count($query)){
            foreach($query as $row ){
                $this->db->where(array('commu_id' => $row->commu_id));
                $this->db->update('tu_commune', array('commu_nu_latitude' => $row->commu_nu_latitude, 'commu_nu_longitude' => $row->commu_nu_longitude ));
            }
            //print_r($query);
        }
    }

	public function index()
	{
 
        $data['main_title'] = 'GL | Fast & Forword';
        $data['template'] ='index';
        $this->load->view('includes/template', $data);
    }

    public function record(){

        $overdue_in_days = array( 0 => 'No overdue' , 1 => 30, 31 => 60, 61 => 90, 91 => 9168 );
        $data = array();
        $i = 0;

        foreach ( $overdue_in_days as $start => $to ) {
  
            $coords = $this->map->Qoverdue( $start, $to );
            if(count( $coords )){
                    
                foreach ($coords as $coordinate) {

                        $i++;
                        $data[$i]['lat'] = $coordinate->lat;
                        $data[$i]['lon'] = $coordinate->lon;
                        $desc = '<b class="text-warning">' . ( $start == 0 ? 'Number leasee no overdue ' . ' ( '.$coordinate->overdue .' )' :  'Number Leasee '. ($to == 9168 ? 'Over 90' : 'in '. $to ) . ' days'.  ' (' .$coordinate->overdue .')' ) . '</b>';
                        $desc .= '<p class="text-info">';
                        $desc .=  $coordinate->distr_desc_en .' District,' .$coordinate->commu_desc_en .' Commune, ' . $coordinate->prvin_desc_en . ' Province'.$coordinate->lat. ',' . $coordinate->lon ;
                        $desc .= '</p>';
                        $data[$i]['desc'] =   $desc;
                        $data[$i]['icon'] =   base_url('assets/images/icons/overdue_in_') . $start .'.png';
                        $data[$i]['overdue_day'] =   $to;
                        $data[$i]['num_row'] =   $i;

                        
                }  

            }
                
        }
        //echo $this->db->last_query();
            
        echo json_encode($data);

    }

	public function live_data_update(){

        $date = ( $this->input->post('n') == 0 ? date("Y-m-d") : date("Y-m-d H:i:s", time() - 100000 ) );
        $fcos = $this->map->get_today_fco( $date );
        //echo $this->db->last_query();

        if(count($fcos)){
            $i = 0;
            $data = array();
            foreach ($fcos as $fco) { 
                  
                $i++;
                $data[$i]['lat'] = $fco->lat;
                $data[$i]['lon'] = $fco->lon;

                $desc = '<div class="fco-wrpper">';
                $desc .= img('http://192.168.7.8:8080/images/'. $fco->path, '', array('class' => 'fco-img'));
                $desc .= '<div class="txt-addr">';
                $desc .= '<h5><b> '.$fco->civil_code.'. '. $fco->perso_va_lastname_en . ' ' .$fco->perso_va_firstname_en.'</b></h5>';
                $desc .= '<p> <b> Number overdue ('.$fco->num_overdue .') </b></p>';
                $desc .= '<p>';
                $desc .=  $fco->distr_desc_en .' Commune,' .$fco->commu_desc_en .' District, ' . $fco->prvin_desc_en . ' Province' ;
                $desc .= '</p>';
                $desc .= '</div>'; 
                $desc .= '</div>'; 
                $data[$i]['desc'] =   $desc;
                $data[$i]['icon'] =   base_url('assets/images/icons/fco.png');

            } 

            $data[$i]['n'] =   $i;
            echo json_encode($data);

        }//FCO
        
         
	}

    public function leasee_comment(){ 
    
        $data['items']= $this->map->get_leasee_comment( date("Y-m-d H:i:s", time() ) );
        echo json_encode($data);
    }

    public function in_day($start, $to){

        $query = $this->map->Qin_days( $start, $to );
        if(count($query)){
            $i = 0;
            $data = array();
            foreach($query as $item){
                $i++;
                $data[$i]['overdue'] = '<li class="itm-lst"> <h6 class="text-warning"> Number of Leasee ('. $item->overdue . ') </h6>';
                $address ='<span class="dropdown">'. anchor('maps/sort_addr_by_id/distr_id/' . $item->distr_id .'/' . $start .'/' . $to, $item->distr_desc_en .' District, ', array('class' => 'dropdown-toggle addr_id', 'data-toggle' => 'dropdown')) .'<ul class="dropdown-menu" role="menu"> <li> <span class="btn btn-link">Loading...</span> </li> </ul></span>';

                $address .= '<span class="dropdown">'. anchor('maps/sort_addr_by_id/prvin_id/' . $item->prvin_id .'/' .$start .'/' .$to, $item->prvin_desc_en .' Province', array('class' => 'dropdown-toggle addr_id', 'data-toggle' => 'dropdown')) .'<ul class="dropdown-menu" role="menu"> <li> <span class="btn btn-link">Loading...</span> </li></ul> </span>';

                $data[$i]['address'] = $address;

            }

            $data[$i]['num'] = $i;
            echo json_encode($data);
        }
        
        
    }


    public function sort_addr_by_id($segment, $id, $start, $to){

        $query = $this->map->sort_addr_by_id($segment, $id, $start, $to);
        if(count($query)){
            $i = 0;
            $data = array();
            $addr = '';
            foreach($query as $item){
                $i++;
                $addr .= '<li class="btn-lnk">';
                $addr .= '<p class="text-info">'. ( $segment == 'prvin_id' ? $item->distr_desc_en .' District'  : $item->commu_desc_en . ' Commune' ) .'<b class="text-warning"> ('. $item->overdue .') </b> '.' </p>';
                $addr .= '</li>';
                $data[$i]['addr'] = $addr;  
            }
            

        }
        echo json_encode($data);
    }

    public function get_today($days = null ){
    
        $data['items']= $this->map->get_today_fco();
        echo json_encode($data);
    
    }


	public function error_404(){

		$data['main_title'] = 'Error 404';
		$data['template'] ='error_404';
		$this->load->view('includes/template', $data);

	}



    public function model(){

        $data['main_title'] = 'Model';
        $data['template'] ='model';
        $this->load->view('includes/template', $data);

    }

}//end class
