<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->library('auth');
        $this->load->library('session');
        $this->auth->check_permission();
        $this->load->model('UserModel');
        $this->load->model('CompanyModel');
    }

    public function users_list()
    {
        $this->load->view('inc/header');
        $this->load->view('users/user_list');
        $this->load->view('inc/footer');

    }

    public function add_user()
    {
        $user = '';
        if (isset($_GET['user_id'])) {
            $user = $this->UserModel->get_user($_GET['user_id']);
        }
        $companies = $this->CompanyModel->getCompanies();
        $this->load->view('inc/header');
        $this->load->view('users/add_user', array('user' => $user, 'company' => $companies));
        $this->load->view('inc/footer');
    }

    public function save_user()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $name = $this->input->post('name');
        $access_level = $this->input->post('access_level');
        $company_id = $this->input->post('company_id');
        $user_id = $this->input->post('user_id');
        if ($user_id) {
            $this->db->where('id', $user_id);
            $this->db->update('users', array(
                'username' => str_replace(' ', '', $username),
                'password' => md5('gil' . $password),
                'name' => $name,
                'access_level' => $access_level,
                'company_id' => $company_id
            ));
        } else {
            $user = $this->UserModel->get_user_by_email($username);
            $data = array();
            if ($user) {
                $data['error'] = 'User Name Already Exists';
            } else {
                $this->db->insert('users', array(
                    'username' => $username,
                    'password' => md5('gil' . $password),
                    'name' => $name,
                    'access_level' => $access_level,
                    'company_id' => $company_id
                ));
                $data['user_id'] = $this->db->insert_id();
            }
        }
        redirect('Users/users_list');
    }

    public function get_userlist()
    {
        $users = $this->UserModel->getUsersNotAdmin();
        $data['data'] = $users;
        echo json_encode($data);
    }

    public function reset_password()
    {
        $user_id = $this->input->post('user_id');
        $new_password = $this->input->post('new_password');
        $this->db->where('id', $user_id);
        $this->db->update('users', array('password' => md5('gil' . $new_password), 'status' => 'Active'));
        echo $user_id;
    }

    public function disable_user()
    {
        $user_id = $this->input->post('user_id');
        $this->db->where('id', $user_id);
        $this->db->update('users', array('status' => 'Disabled'));
        echo $user_id;
    }

    public function delete_user()
    {
        $user_id = $this->input->post('user_id');
        $this->db->where('id', $user_id);
        $this->db->delete('users');
        echo $user_id;
    }
}