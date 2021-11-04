<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('session');
        $this->load->model('UserModel');
    }

    public function index()
    {
        if ($this->auth->is_logged()) {
            $this->output->set_header("Location: " . base_url() . 'Dashboard', TRUE, 302);
        } else {

            $this->load->view('login/index');
        }
    }

    public function do_login()
    {
        $error = '';
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->UserModel->get_user_by_email($username);

        if (!is_object($user)) {
            $error = 'Wrong Username';
        } elseif ($user->status == 'Disabled') {
            $error = 'Your account has been disabled';
        } elseif ($user->status == 'Blocked') {
            $error = 'Your account has been blocked';
        }elseif (!$user->company_id) {
            $error = 'Quoting company isn\'t defined for the user';
        } elseif (generate_password($password) != $user->password) {
            if ($user->login_attempts > 3) {
                $this->_block_user($username);
                $error = 'Your account has been blocked';
            } else {
                $this->_increase_login_attempts($username);
                $error = 'Wrong Password Login attempts ' . ($user->login_attempts + 1);
            }
        } else {
            if($this->auth->login($username, $password)){
                $this->_clear_attempts($username);
            }
        }
       // echo "as";
       // die();
        if ($error != '') {
            $this->session->set_userdata(array('error_message' => $error));
            $this->output->set_header("Location: " . base_url() . 'Login', TRUE, 302);
        } else {
            $this->output->set_header("Location: " . base_url() . 'Dashboard', TRUE, 302);
        }
    }

    private function _increase_login_attempts($username)
    {

        $this->db->set('login_attempts', 'login_attempts + 1', FALSE);
        $this->db->where('username', $username);
        $this->db->update('users');

    }

    private function _clear_attempts($username)
    {
        $this->db->set('login_attempts', 0, FALSE);
        $this->db->where('username', $username);
        $this->db->update('users');

    }

    private function _block_user($username)
    {
        $this->db->set('status', 'Blocked');
        $this->db->set('login_attempts', 0);
        $this->db->where('username', $username);
        $this->db->update('users');

        if ($this->db->affected_rows() == 1) {
            return true;
        }

        return false;
    }

    public function do_logout()
    {
        if ($this->auth->logout()) {
            $this->output->set_header("Location: " . base_url() . 'Login', TRUE, 302);
        }
    }

    public function go_to_error_page()
    {
        $this->load->view('inc/header');
        $this->load->view('inc/error');
        $this->load->view('inc/footer');
    }
}
