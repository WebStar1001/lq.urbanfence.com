<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserModel extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

    }

    public function getUsers()
    {
        $query = $this->db->get('users');
        return $query->result();
    }
    public function getUsersNotAdmin()
    {
        $query = $this->db->select('*')
                ->from('users')
                ->where('access_level <> "Admin"', null, false)->get();
        return $query->result();
    }

    public function get_user($user_id)
    {
        $query = $this->db->get_where('users', array('id' => $user_id));
        return $query->row();
    }

    public function get_user_by_email($email)
    {
        $query = $this->db->get_where('users', array('username' => $email));
        return $query->row();
    }


    public function getUserByAccessLevel($access_level)
    {
        $this->db->select('*')
            ->from('users')
            ->where('status != "Disabled"', null, false)
            ->where('access_level', $access_level);

        if(!is_admin()){
            $this->db->where('company_id', user_company());
        }
        $query = $this->db->get();

        return $query->result();
    }
    public function getSalesByCompany($company_id){
        $this->db->select('*')
            ->from('users')
            ->where('status != "Disabled"', null, false)
            ->where('access_level', 'Sales')
            ->where('company_id', $company_id);
        $query = $this->db->get();

        return $query->result();
    }
    public function getManagersByCompany($company_id){
        $this->db->select('*')
            ->from('users')
            ->where('status != "Disabled"', null, false)
            ->where('access_level', 'Manager')
            ->where('company_id', $company_id);
        $query = $this->db->get();

        return $query->result();
    }

    function check_valid_user($username, $password)
    {

        $password = md5("gil" . $password);
        $this->db->where(array('username' => $username, 'password' => $password, 'status' => 1));

        $query = $this->db->get('users');
        $user = $query->row();

        if (is_object($user)) {
            return $user;
        }
        return false;
    }
    public function getManagersByCompanyID($company_id){
        $query = $this->db->get_where('users', array('company_id'=>$company_id, 'access_level'=>'Manager'));
        return $query->result();
    }
    public function getManagerByUserName($username, $company_id){
        $this->db->select('*')
            ->from('users')
            ->where('status != "Disabled"', null, false)
            ->where('access_level', 'Manager')
            ->where('company_id', $company_id)
            ->where('name', $username);
        $query = $this->db->get();
        return $query->row();
    }
}
