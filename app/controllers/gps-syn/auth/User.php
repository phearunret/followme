<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Gps_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->model('auth/user_model', 'u');
        $this->load->helper('auth/user_helper');
    }

    public function index()
    {

        $data['main_title'] = 'Users';
        $data['query'] = $this->u->read($id = null);
        $data['template'] = 'auth/index';
        $this->load->view('gps-syn/includes/template', $data);
    }


    /*
     * Display user create.
     */
    public function create()
    {

        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tu_gps_syn_usr.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[password]');
            if ($this->form_validation->run() == FALSE) {

                $data['main_title'] = 'Create';
                $data['template'] = 'auth/create';
                $this->load->view('gps-syn/includes/template', $data);

            } else {
                $input_data['first_name'] = $this->input->post('fname', TRUE);
                $input_data['last_name'] = $this->input->post('lname', TRUE);
                $input_data['email'] = $this->input->post('email', TRUE);
                $input_data['password'] = $this->input->post('password', TRUE);

                $input_data['password'] = $this->encrypt->encode($input_data['password']);

                $input_data['usr_activation_link'] = generate_random() . time();
                $input_data['created_on'] = date("Y-m-d H:i:s");


                $user_id = 0;
                $user_id = $this->u->update_user($input_data);

                if (!empty($user_id)) {

                    //$this->user_create_activation_sendmail($input_data);
                    //$this->session->set_flashdata('success','Activation link sent to your email. Please active.');
                    $this->session->set_flashdata('success', 'The record was saved.');
                    redirect('auth/user/create');
                } else {
                    $this->session->set_flashdata('failure', 'Thre was a problem please try again later.');
                    redirect('auth/user/create');
                }
            }
        } else {
            $data['main_title'] = 'Create';
            $data['template'] = 'auth/create';
            $this->load->view('gps-syn/includes/template', $data);
        }
    }

    public function user_create_activation_sendmail($input_data)
    {
        $this->load->helper('auth/email_helper');
        $template_config = array(
            'type' => 'send_activation_link',
            'name' => ucwords($input_data['first_name']),
            'email' => $input_data['email'],
            'usr_activation_link' => $input_data['usr_activation_link']
        );
        $message_details = message_template($template_config);
        $headers = "From: Bhaskar (bhaskarpanja@gmail.com)";
        $mail_config = array('to' => $input_data['email'],
            'subject' => 'User Activation Link',
            'message' => $message_details,
            'headers' => $headers
        );
        send_email($mail_config);
    }

    public function active_user()
    {
        $random_string = $this->uri->segment(4);

        $user_details = $this->u->get_user_details_by_randomstring($random_string);
        if (!empty($user_details)) {
            $status = $this->u->update_active_user($random_string);
            if ($status == 1) {
                $this->session->set_flashdata('success', 'Your account has been activated. Please login..');
                redirect('auth/user');
            } else {
                $this->session->set_flashdata('failure', 'There was a problem to activate your account. Try again later.');
                redirect('auth/user');
            }
        } else {
            $this->session->set_flashdata('failure', 'Acount already activated. Please login..');
            redirect('auth/user');
        }
    }


    /*
    *   Forget password code.
    */
    public function forget_password()
    {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/forget_password');
            } else {
                $email = $this->input->post('email');
                $status = $this->u->check_email_exist($email);
                if ($status == 1) {
                    $user_details = $this->u->get_user_details($email);

                    $data['forget_password_random_string'] = generate_random() . time();
                    $data['email'] = $email;

                    $forget_password_status = $this->u->update_forget_password_random_string($data);
                    if ($forget_password_status) {
                        $email_data = array();
                        $email_data['email'] = $user_details['email'];
                        $email_data['first_name'] = $user_details['first_name'];
                        $email_data['last_name'] = $user_details['last_name'];
                        $email_data['reset_password_link'] = $data['forget_password_random_string'];
                        $this->user_forget_sendmail($email_data);
                        $this->session->set_flashdata('success', 'Please check your email. The password reset link has been sent your email.');
                        redirect('auth/user/forget_password');
                    } else {
                        $this->session->set_flashdata('failure', 'Thre was a problem please try again later.');
                        redirect('auth/user/forget_password');
                    }
                } else {
                    $this->session->set_flashdata('failure', 'Email does not exist.');
                    redirect('auth/user/forget_password');
                }
            }
        } else {
            if (!empty($this->session->userdata('logged_in')))
                redirect('auth/user/dashboard');
            $this->load->view('auth/forget_password');
        }

    }

    /*
    *   Send Forget password mail.
    */
    public function user_forget_sendmail($email_data)
    {
        $this->load->helper('auth/email_helper');
        $template_config = array(
            'type' => 'forget_password',
            'email' => $email_data['email'],
            'first_name' => $email_data['first_name'],
            'last_name' => $email_data['last_name'],
            'reset_password_link' => $email_data['reset_password_link'],

        );
        $message_details = message_template($template_config);

        $headers = "From: way2php.com (bhaskarpanja@gmail.com)";
        $mail_config = array('to' => $email_data['email'],
            'subject' => 'Way2php Password Request',
            'message' => $message_details,
            'headers' => $headers
        );
        send_email($mail_config);
    }

    /*
    *   Reset password
    */
    public function reset_password()
    {
        $random_string = $this->uri->segment(4);
        $user_details = $this->u->get_user_details_reset_password($random_string);
        if (!empty($user_details)) {
            if ($random_string == $user_details['forget_password_random_string']) {
                if ($this->input->post()) {
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
                    $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[password]');
                    if ($this->form_validation->run() == FALSE) {
                        $data = array();
                        $data['random_string'] = $random_string;
                        $this->load->view('auth/password_reset', $data);
                    } else {
                        $password = $this->input->post('password');
                        $input_data['password'] = $this->encrypt->encode($password);
                        $input_data['email'] = $user_details['email'];
                        $input_data['reset_password_link'] = $random_string;
                        $status = $this->u->update_password($input_data);
                        if ($status) {
                            $this->u->update_reset_link($input_data['email']);
                            $this->session->set_flashdata('success', 'Password reset was successfully complete. Please login with new password.');
                            redirect('auth/user');
                        } else {
                            $this->session->set_flashdata('failure', 'There was a problem. Please try again later..');
                            redirect('auth/user/forget_password');
                        }
                    }
                } else {
                    $data = array();
                    $data['random_string'] = $random_string;
                    $this->load->view('auth/password_reset', $data);
                }
            } else {
                $this->session->set_flashdata('failure', 'Invalid request.');
                redirect('auth/user/forget_password');
            }
        } else {
            $this->session->set_flashdata('failure', 'Invalid request.');
            redirect('auth/user/forget_password');
        }
    }

    /*
    *   Password change
    */
    public function change_password()
    {

        // check_user_sess();
        if ($this->input->post()) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $data['main_title'] = 'Change password';
                $data['template'] = 'auth/change_password';
                $this->load->view('gps-syn/includes/template', $data);
            } else {
                $password = $this->input->post('password');
                $input_data['password'] = $this->encrypt->encode($password);
                $input_data['email'] = $this->session->userdata('logged_in')['email'];
                $status = $this->u->update_change_password($input_data);
                if ($status) {
                    $this->session->set_flashdata('success', 'Password reset was successfully complete.');
                    redirect('gps-syn/auth/user/change_password');
                } else {
                    $this->session->set_flashdata('failure', 'There was a problem. Please try again later..');
                    redirect('gps-syn/auth/user/change_password');
                }
            }
        } else {
            $data['main_title'] = 'Change password';
            $data['template'] = 'auth/change_password';
            $this->load->view('gps-syn/includes/template', $data);
        }
    }

    /*
    *   User logout
    */
    public function logout()
    {
        check_user_sess();
        if ($this->session->userdata('logged_in')) {
            $this->session->unset_userdata('logged_in');
            $this->session->sess_destroy();
            redirect('login');
        }
    }
}

