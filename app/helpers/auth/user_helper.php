<?php
    /** Generating Random key for the use of sending activation link. **/
    function generate_random()
    {
        // Character List to Pick from
            $chrList = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Minimum/Maximum times to repeat character List to seed from
            $chrRepeatMin = 1; // Minimum times to repeat the seed string
            $chrRepeatMax = 10; // Maximum times to repeat the seed string

            // Length of Random String returned
            $chrRandomLength = mt_rand(8, 25);

            // The ONE LINE random command with the above variables.
            return substr(str_shuffle(str_repeat($chrList, mt_rand($chrRepeatMin,$chrRepeatMax))),1,$chrRandomLength);
    }

    /** Function  to check user session  exists or not **/
    function check_user_sess()
    {
        $ci_obj = &get_instance();
        if ($ci_obj->session->userdata('logged_in')) {
            return true;
        }
        else
        {
            //redirect(base_url().'login');
            $ci_obj->session->set_flashdata('failure', 'Login Required');
            redirect('auth/user');
        }
    }
?>