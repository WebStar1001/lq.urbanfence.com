<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class QuoteModel extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

    }

    public function getQuoteList()
    {
        $quote_id = $this->input->get('quote_id');
        $status = $this->input->get('status');
        $customer_id = $this->input->get('customer_id');
        $quote_selling_total = $this->input->get('selling_total');
        $job_type = $this->input->get('job_type');
        $quote_date = $this->input->get('quote_date');
        $sale_rep = $this->input->get('sale_rep');
        $customer = $this->input->get('customer');
        $oppor_id = $this->input->get('oppor_id');
        $site_city = $this->input->get('site_city');
        $company_id = $this->input->get('company_id');
        $this->db->select('quotes.*,date(quotes.created_at) AS quote_date, customers.customer AS customer, users.name AS sale_rep, 
        opportunities.job_type AS job_type, opportunities.site_city AS site_city, opportunities.site_address AS site_address,
        customers.contact_person AS contact_person, companies.name AS company');
        $this->db->from('quotes');
        $this->db->join('customers', 'quotes.customer_id = customers.id', 'inner');
        $this->db->join('opportunities', 'quotes.oppor_id = opportunities.id', 'inner');
        $this->db->join('users', 'opportunities.sale_rep = users.id', 'left');
        $this->db->join('companies', 'companies.id = quotes.company_id', 'left');
        if ($quote_id) {
            $this->db->where('quotes.id', $quote_id);
        }
        if ($status) {
            $this->db->where('quotes.status', $status);
        }
        if ($customer_id) {
            $this->db->where('quotes.customer_id', $customer_id);
        }
        if ($job_type) {
            $this->db->where('opportunities.job_type', $job_type);
        }
        if ($quote_date) {
            list($start_date, $end_date) = explode('-', $quote_date);
            $this->db->where('date(quotes.created_at) BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" AND "' . date('Y-m-d', strtotime($end_date)) . '"', "", FALSE);
        }
        if ($sale_rep) {
            $this->db->where('opportunities.sale_rep', $sale_rep);
        }
        if ($customer) {
            $this->db->like('customers.customer', $customer);
        }
        if ($oppor_id) {
            $this->db->where('quotes.oppor_id', $oppor_id);
        }
        if ($site_city) {
            $this->db->like('opportunities.site_city', $site_city);
        }
        if(is_admin()){
            if ($company_id) {
                $this->db->where('quotes.company_id', $company_id);
            }
        }else{
            $this->db->where('quotes.company_id', user_company());
        }
        if ($quote_selling_total) {

        }
        $this->db->order_by('quotes.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_quote($quote_id)
    {
        $query = $this->db->get_where('quotes', array('id' => $quote_id));
        return $query->row();
    }

    public function get_matinfo($quote_id)
    {
        $this->db->select('mat_details.*, product_catalogs.mat_description AS mat_description');
        $this->db->from('mat_details');
        $this->db->join('product_catalogs', 'mat_details.code=product_catalogs.mat_code', 'left');
        $this->db->where('quote_id', $quote_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_labinfo($quote_id)
    {
        $query = $this->db->get_where('lab_details', array('quote_id' => $quote_id));
        return $query->result();
    }

    public function get_miscinfo($quote_id)
    {
        $query = $this->db->get_where('misc_details', array('quote_id' => $quote_id));
        return $query->result();
    }

    public function get_add_oninfo($quote_id)
    {
        $query = $this->db->get_where('add_on_details', array('quote_id' => $quote_id));
        return $query->result();
    }

    public function getQuoteDatas($quote_id)
    {
        $this->db->select('quotes.*,companies.name AS company_name,customers.customer AS customer_name
        ,opportunities.site_address AS site_address, opportunities.site_city AS site_city,opportunities.job_type AS job_type
        , opportunities.site_postal_code AS site_postal_code');
        $this->db->from('quotes');
        $this->db->where('quotes.id', $quote_id);
        $this->db->join('companies', 'quotes.company_id=companies.id', 'left');
        $this->db->join('customers', 'quotes.customer_id=customers.id', 'left');
        $this->db->join('opportunities', 'quotes.oppor_id=opportunities.id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function getProfitByQuoteID($quote_id)
    {
        $quote = $this->db->get_where('quotes', array('id' => $quote_id))->row();
        $mat_net = $quote->mat_net * 1;
        $mat_factor = $quote->mat_factor * 1 - 1;
        $lab_net = $quote->labour_net * 1;
        $lab_factor = $quote->lab_factor * 1 - 1;
        $misc_net = $quote->misc_net * 1;
        $misc_factor = $quote->misc_factor * 1 - 1;
        $add_on_net = $quote->ads_on_net * 1;
        $add_on_factor = $quote->ads_on_factor * 1 - 1;
        return round($mat_net * $mat_factor + $lab_net * $lab_factor + $misc_net * $misc_factor + $add_on_net * $add_on_factor, 2);
    }
}
