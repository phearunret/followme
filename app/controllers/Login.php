<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Login extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->load->library('encrypt');
            $this->load->library('session');
            $this->load->model('auth/user_model');
            $this->load->helper('auth/user_helper');
        }
	    public function index()
	    {
            if(!empty($this->session->userdata('logged_in')))
                redirect('auth/user/dashboard');
            if(!empty($this->input->post()))
            {
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->view('login');
                }
                else
                {
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $check_auth = $this->user_model->authenticate($email,$password);
                    if($check_auth)
                    {
                        redirect('gps-syn/dashboard');
                    }
                    else
                    {
                        redirect('login');
                    }
                }
            }
            else
            {
                $this->load->view('login');
            }
	    }


	}

