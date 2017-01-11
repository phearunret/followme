<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fcco extends CI_Controller {

	function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('gps-syn/maps/fcco_model', 'fcco');
    

    }
 
	public function index($id = null)
	{
 
        $data['main_title'] = 'Records - fcco';
        $data['query'] = $this->fcco->rquery($id, 'td_lessee_overdue_paid', null);
		$data['template'] ='maps/fcco/index';
		$this->load->view('gps-syn/includes/template', $data);
	}

    public function edit($id = null)
    {
       
        $this->form_validation->set_rules('leodu_latitue', 'Latitude', 'trim|required');
        $this->form_validation->set_rules('leodu_longtitue', 'Longitude', 'trim|required');
        
        
        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
          
            $data['main_title'] = 'Insert Fcco Activities';
            $data['template'] ='maps/fcco/edit';
            $this->load->view('gps-syn/includes/template', $data);

        }
        else
        {
  
            //Check whether user upload picture
            if(!empty($_FILES['picture']['name'])){
                $config['upload_path'] = './assets/images/uploads';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['picture']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
            }else{
                $picture = '';
            }
            
    
        
            $data = array(

                'appli_bo_id' => $this->input->post('appli_bo_id'),
                'leodu_latitue' => $this->input->post('leodu_latitue'),
                'leodu_longtitue' => $this->input->post('leodu_longtitue'),
                'leodu_photopath' => $picture,
                'dt_cre' => date("Y-m-d H:i:s"),
                'usr_cre' => date("Y-m-d H:i:s"),
                'usr_upd' => 'CC',
                'dt_upd' => date("Y-m-d H:i:s"),
                'leodu_received_date' => date("Y-m-d H:i:s")
            );

            
            // saved form data into database
            if ($this->db->insert('td_lessee_overdue_paid', $data ))
            {
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully saved!  </div>');
                redirect('gps-syn/fcco');
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('gps-syn/fcco');
            }
        }
        
       
    }

    public function delete($id = null )
    {
         if ($this->db->delete('td_lessee_overdue_paid', array('leodu_id' => $id ) ))
            {
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully delete(d)!  </div>');
                redirect('gps-syn/fcco');
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('gps-syn/fcco');
            }
         
    
    }


     
 
    
    
}//end class
