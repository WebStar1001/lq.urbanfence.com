<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class OpportunityModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function getOpportunities()
    {
        $job_type = $this->input->get('job_type');
        $company_id = $this->input->get('company_id');
        $phone = $this->input->get('phone');
        $status = $this->input->get('status');
        $sale_rep = $this->input->get('sale_rep');
        $customer = $this->input->get('customer');
        $id = $this->input->get('id');
        $customer_id = $this->input->get('customer_id');
        $date = $this->input->get('date');
        $site_city = $this->input->get('site_city');
        $site_postal_code = $this->input->get('site_postal_code');
        $this->db->select('opportunities.*, customers.customer AS customer, customers.contact_person AS contact_person, 
                        quotes.id AS quote_id,companies.name AS company');
        $this->db->from('opportunities');
        if ($id) {
            $this->db->where('opportunities.id', $id);
        }
        if ($job_type) {
            $this->db->where('job_type', $job_type);
        }
        if ($phone) {
            $this->db->where('REPLACE(cphone1, "-", "") = '.intval($phone), null, false);
            $this->db->or_where('REPLACE(phone2, "-", "") = '.intval($phone), null, false);
        }
        if ($status) {
            $this->db->where('opportunities.status', $status);
        }
        if ($sale_rep) {
            $this->db->where('sale_rep', $sale_rep);
        }
        if ($customer) {
            $this->db->like('ccustomer', $customer);
        }
        if ($customer_id) {
            $this->db->where('opportunities.customer_id', $customer_id);
        }
        if (is_admin()) {
            if ($company_id) {
                $this->db->where('opportunities.company_id', $company_id);
            }
        } else {
            $this->db->where('opportunities.company_id', user_company());
        }
        if ($site_city) {
            $this->db->where('site_city', $site_city);
        }
        if ($date) {
            list($start_date, $end_date) = explode('-', $date);
            $this->db->where('date >= "' . date('Y-m-d', strtotime($start_date)) . '"', null, false);
            $this->db->where('date <= "' . date('Y-m-d', strtotime($end_date)) . '"', null, false);
        }
        if ($site_postal_code) {
            $this->db->where('site_postal_code', $site_postal_code);
        }
        $this->db->join('customers', 'customers.id=opportunities.customer_id', 'inner');
        $this->db->join('quotes', 'quotes.oppor_id=opportunities.id', 'left');
        $this->db->join('companies', 'companies.id=opportunities.company_id', 'inner');
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_opportunity($opportunity_id)
    {
        $this->db->select('opportunities.*, users.name AS sale_rep, customers.customer AS customer_name');
        $this->db->from('opportunities');
        $this->db->where('opportunities.id', $opportunity_id);
        $this->db->join('users', 'opportunities.sale_rep=users.id', 'left');
        $this->db->join('customers', 'customers.id=opportunities.customer_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }
}
