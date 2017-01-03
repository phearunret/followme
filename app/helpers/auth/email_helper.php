<?php
    function message_template($template_config)
    {
        $result = array();

        $msg_config = $template_config;
        
        if($msg_config['type']=='send_activation_link')
        {
            $result['message'] = '<p>Hello &nbsp;&nbsp;'.$msg_config['name'].'</p>';
            $result['message'] .= '<p>Your activation link as below. Please click this link to activate your account.</p>';
            $result['message'] .= '<p><a href="'.base_url('auth/user/active_user').'/'.$msg_config['user_activation_link'].'" target="_blank">Activation Link</a></p>';
        }
        else if($msg_config['type']=='forget_password')
        {
            $result['message'] = '<p>Hello &nbsp;&nbsp;'.$msg_config['first_name'].' '.$msg_config['last_name'].'</p>';
            $result['message'] .= '<p>Your password reset link as below. Please click this link to reset your account password.</p>';
            $result['message'] .= '<p><a href="'.base_url('auth/user/reset_password').'/'.$msg_config['reset_password_link'].'" target="_blank">Reset Password Link</a></p>';
        }
        return $result;
    }
    

    function send_email($email_data)
    {
        $CI = & get_instance();

        $CI->load->library('email');

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.googlemail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = '';
        //$config['smtp_crypto']  = 'ssl';
        $config['smtp_pass']    = '';
        $config['charset']    = 'iso-8859-1';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; 
        //$config['validation'] = false; // bool whether to validate email or not
        $CI->email->initialize($config);

        $CI->email->from('bhaskarpanja@gmail.com', 'way2php.com');
        $CI->email->to($email_data['to']);
        $CI->email->subject($email_data['subject']);

        $body = $CI->load->view('auth/email_template',$email_data['message'],TRUE); 
        $CI->email->message($body); 

        if($CI->email->send())
            return "email sent!";
        else 
            return "failed";
    }
?>
