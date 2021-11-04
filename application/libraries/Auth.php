<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
    //Login....
    public function login($username, $password)
    {
        $CI =& get_instance();

        $CI->load->model('UserModel');

        $user = $CI->UserModel->check_valid_user($username, $password);


        if ($user) {
            $key = md5(time());
            $key = str_replace("1", "z", $key);
            $key = str_replace("2", "J", $key);
            $key = str_replace("3", "y", $key);
            $key = str_replace("4", "R", $key);
            $key = str_replace("5", "Kd", $key);
            $key = str_replace("6", "jX", $key);
            $key = str_replace("7", "dH", $key);
            $key = str_replace("8", "p", $key);
            $key = str_replace("9", "Uf", $key);
            $key = str_replace("0", "eXnyiKFj", $key);

            $sid_web = substr($key, rand(0, 3), rand(28, 32));

            // codeigniter session stored data          
            $user_data = array(
                'sid_web' => $sid_web,
                'isLogIn' => true,
                'isAdmin' => (($user->access_level == 'Admin') ? true : false),
                'user_id' => $user->id,
                'access_level' => $user->access_level,
                'user_name' => $user->name,
                'user_email' => $user->username,
                'company_id' => $user->company_id,
                'status' => $user->status,
            );

            $CI->session->set_userdata($user_data);

            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_access_level(){

        $CI =& get_instance();

        return $CI->session->userdata('access_level');
    }
    //Check if is logged....
    public function is_logged()
    {
        $CI =& get_instance();
        if ($CI->session->userdata('sid_web')) {
            return true;
        }
        return false;
    }

    //Logout....
    public function logout()
    {
        $CI =& get_instance();
        $user_data = array(
            'sid_web' => '',
            'user_id' => '',
            'user_type' => '',
            'user_name' => ''
        );
        $CI->session->sess_destroy($user_data);
        return true;
    }

    //Check for logged in user is Admin or not.

    public function is_admin()
    {
        // || $CI->session->userdata('user_type')==2
        $CI =& get_instance();
        if ($CI->session->userdata('user_type') == 1) {
            return true;
        }
        return true;
    }

    function check_permission($url = '')
    {
        $permission_array = array();
        if ($url == '') {
            $url = base_url() . 'Login';
        }
        $CI =& get_instance();

        if (!$this->is_logged()) {

            $this->logout();

            $error = "You are not authorized for this part";

            $CI->session->set_userdata(array('error_message' => $error));
            redirect($url, 'refresh');

        }else{
            if(is_manager()){
                if($CI->uri->segment(1) == 'Users'){
                    redirect('Login/go_to_error_page');
                }
            }elseif(is_sale()){
                if($CI->uri->segment(1) == 'Users'){
                    redirect('Login/go_to_error_page');
                }
                if($CI->uri->segment(1) == 'Opportunity'&&$CI->uri->segment(2) == 'opportunity_list' && isset($_GET['status'])){
                    redirect('Login/go_to_error_page');
                }
                if($CI->uri->segment(1) == 'Quote'&&$CI->uri->segment(2) == 'quotes_list' && isset($_GET['status'])){
                    redirect('Login/go_to_error_page');
                }
                if($CI->uri->segment(1) == 'Jobs'&&$CI->uri->segment(2) == 'job_detail'){
                    redirect('Login/go_to_error_page');
                }
            }elseif (is_user()){
                if($CI->uri->segment(1) == 'Users'){
                    redirect('Login/go_to_error_page');
                }
                if($CI->uri->segment(1) == 'Opportunity'&&$CI->uri->segment(2) == 'opportunity_list' && isset($_GET['status'])){
                    redirect('Login/go_to_error_page');
                }
                if($CI->uri->segment(1) == 'Quote'){
                    redirect('Login/go_to_error_page');
                }
            }
        }
    }

    //This function is used to Generate Key
    public function generator($lenth)
    {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 34);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

}


?>