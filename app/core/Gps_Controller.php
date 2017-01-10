<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author s.phourng
 */
class Gps_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->_logged_in();

    }

    protected function _logged_in()
    {
        if( $this->session->userdata('logged_in') == false ){
            redirect('Login');
        }

    }


}

