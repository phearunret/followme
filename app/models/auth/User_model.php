<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class User_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('encrypt');
            $this->load->library('session');
            $this->load->database();
        }

        public function read($id = null ){
            if(is_null( $id )){
                return $this->db->get('tu_gps_syn_usr')->result();
            }else{
                return $this->db->get_where('tu_gps_syn_usr', array('syn_usr_id' => $id ))->row();
            }
        }

	    public function authenticate($email, $password)
        {
            $this->db->select('*');
            $this->db->from('tu_gps_syn_usr');        
            $this->db->where('LOWER(email)', $email);
            $query = $this->db->get();

            if($query->num_rows() > 0)
            {
               $user = $query->row(); //echo $user->user_status; exit;
               if($user->status == 1)
               {
                    if($this->encrypt->decode($user->password) === $password)
                    {
                        //store user data into session
                        $sess_array = array(
                            'user_id' => $user->id,
                            'fname' => $user->first_name, 
                            'lname' => $user->last_name,                        
                            'email' => $user->email
                        );
                        $this->session->set_userdata('logged_in',$sess_array);              
                        return true;                    
                    }
                    else
                    {
                        $this->session->set_flashdata('failure','Incorrect password.');
                        return false;
                    }
                }
                else
                {
                    $this->session->set_flashdata('failure','Inactive user login');
                    return false;
                }
            }
            else
            {
                $this->session->set_flashdata('failure','Invalid Email.');
                return false;
            } 
        }

        public function update_user($userdata)
        {

            $this->db->insert('tu_gps_syn_usr', $userdata); 
            $insertid = $this->db->insert_id();
            return $insertid;
        }

        public function update_active_user($random_string)
        {
            $this->db->set('status', 1);
            $this->db->set('usr_activation_link', '');
            $this->db->where('usr_activation_link', $random_string);
            return $this->db->update('tu_gps_syn_usr'); 
        }

        public function get_user_details_by_randomstring($random_string)
        {
            $this->db->select('*');
            $this->db->from('tu_gps_syn_usr');        
            $this->db->where('usr_activation_link', $random_string);
            $query = $this->db->get();
            return $query->row_array();
        }

         /*
        *   Check for email whether exist or not.
        */
        public function check_email_exist($email)
        {
            $this->db->select('*');
            $this->db->from('tu_gps_syn_usr');
            $this->db->where('email', $email);
            $query = $this->db->get();
            return $query->num_rows();
        }

        /*
        *   Get the user details using user id.
        */
        public function get_user_details($email)
        {
            $this->db->select('*');
            $this->db->from('tu_gps_syn_usr');
            $this->db->where('email', $email);
            $query = $this->db->get();
            return $query->row_array();
        }

        /*
        *   Update the forget password sending link
        */
        public function update_forget_password_random_string($data)
        {
            $this->db->set('forget_password_random_string', $data['forget_password_random_string']);
            $this->db->where('email', $data['email']);
            return $this->db->update('tu_gps_syn_usr'); 
        }

        /*
        *   Get usr details based on password reset random string
        */
        public function get_user_details_reset_password($random_string)
        {
            $this->db->select('*');
            $this->db->from('tu_gps_syn_usr');        
            $this->db->where('forget_password_random_string', $random_string);
            $query = $this->db->get();
            return $query->row_array();
        }

        /*
        *   Password reset
        */
        public function update_password($data)
        {
            $this->db->set('password', $data['password']);
            $this->db->where('forget_password_random_string', $data['reset_password_link']);
            $this->db->where('email', $data['email']);
            return $this->db->update('tu_gps_syn_usr'); 
        }

        /*
        *   Remove reset password link after passwordreset
        */
        public function update_reset_link($email)
        {
            $this->db->set('forget_password_random_string', ' ');
            $this->db->where('email', $email);
            return $this->db->update('tu_gps_syn_usr'); 
        }

        /*
        *   Change password by user
        */
         public function update_change_password($data)
        {
            $this->db->set('password', $data['password']);
            $this->db->where('email', $data['email']);
            return $this->db->update('tu_gps_syn_usr'); 
        }
	}



