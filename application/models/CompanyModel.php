<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CompanyModel extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function getCompanies(){
        $query = $this->db->get('companies');
        return $query->result();
    }

}
