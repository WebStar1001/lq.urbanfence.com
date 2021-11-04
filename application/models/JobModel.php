<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class JobModel extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

    }

    public function getJobByJobID($job_id)
    {
        $query = $this->db->get_where('jobs', array('id' => $job_id));
        return $query->row();
    }

    public function getJobs()
    {
        $job_id = $this->input->get('job_id');
        $status = $this->input->get('status');
        $quote_id = $this->input->get('quote_id');
        $installer = $this->input->get('installer');
        $job_balance = $this->input->get('job_balance');
        $company_id = $this->input->get('company_id');
        $customer = $this->input->get('customer');
        $job_type = $this->input->get('job_type');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $site_city = $this->input->get('site_city');

        $this->db->select('jobs.*, customers.customer AS customer, customers.contact_person AS contact_person,
        opportunities.job_type AS job_type,opportunities.site_address AS site_address,opportunities.contact_onsite AS contact_onsite,
        opportunities.site_city AS site_city, users.name AS installer, companies.name AS company');
        $this->db->from('jobs');
        if ($job_id) {
            $this->db->where('jobs.id', $job_id);
        }
        if ($status) {
            $this->db->where('jobs.status', $status);
        }
        if ($quote_id) {
            $this->db->where('jobs.quote_id', $quote_id);
        }
        if ($installer) {
            $this->db->where('jobs.installer', $installer);
        }
        if ($job_balance) {
            $this->db->where('job_balance >= ' . $job_balance, null, false);
        }
        if ($customer) {
            $this->db->like('customers.customer', $customer);
        }
        if (is_admin()) {
            if ($company_id) {
                $this->db->where('jobs.company_id', $company_id);
            }
        }else{
            $this->db->where('jobs.company_id', user_company());
        }
        if ($job_type) {
            $this->db->where('opportunities.job_type', $job_type);
        }
        if ($start_date) {
            list($from_date, $to_date) = explode('-', $start_date);
            $this->db->where('start_date BETWEEN "' . date('Y-m-d', strtotime($from_date)) . '" AND "' . date('Y-m-d', strtotime($to_date)) . '"', "", FALSE);
        }
        if ($end_date) {
            list($from_date, $to_date) = explode('-', $end_date);
            $this->db->where('end_date BETWEEN "' . date('Y-m-d', strtotime($from_date)) . '" AND "' . date('Y-m-d', strtotime($to_date)) . '"', "", FALSE);
        }
        if ($site_city) {
            $this->db->where('site_city', $site_city);
        }
        $this->db->join('customers', 'customers.id=jobs.customer_id', 'inner');
        $this->db->join('users', 'users.id=jobs.installer', 'left');
        $this->db->join('opportunities', 'opportunities.id=jobs.oppor_id', 'inner');
        $this->db->join('companies', 'companies.id=jobs.company_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSalesData()
    {
        $company_id = $this->input->get('company_id');
        $sale_source = $this->input->get('sale_source');
        $customer = $this->input->get('customer');
        $job_per_month = $this->input->get('job_per_month');
        $job_balance = $this->input->get('job_balance');
        $start_date = $this->input->get('start_date');
        $sale_rep = $this->input->get('sale_rep');
        $installer = $this->input->get('installer');
        $site_city = $this->input->get('site_city');
        $job_type = $this->input->get('job_type');

        $this->db->select('jobs.*, companies.name AS company,customers.customer AS customer, opportunities.job_type AS job_type 
        ,opportunities.sale_source AS sale_source,sale_rep.name AS sale_rep,opportunities.site_city AS site_city, 
        installer.name AS installer');
        $this->db->from('jobs');
        if ($company_id) {
            $this->db->where('jobs.company_id', $company_id);
        }
        if ($sale_source) {
            $this->db->where('opportunities.sale_source', $sale_source);
        }
        if ($customer) {
            $this->db->like('customers.customer', $customer);
        }
        if ($job_per_month) {
            $this->db->where('MONTH(jobs.start_date)', $job_per_month);
        }
        if ($job_balance) {
            $this->db->where('job_balance >= ' . $job_balance, null, false);
        }
        if ($start_date) {
            $this->db->where('jobs.start_date', date('Y-m-d', strtotime($start_date)));
        }
        if ($sale_rep) {
            $this->db->where('opportunities.sale_rep', $sale_rep);
        }
        if ($job_type) {
            $this->db->where('opportunities.job_type', $job_type);
        }
        if ($installer) {
            $this->db->where('jobs.installer', $installer);
        }
        if ($site_city) {
            $this->db->where('opportunities.site_city', $site_city);
        }
        $this->db->join('companies', 'companies.id=jobs.company_id', 'inner');
        $this->db->join('customers', 'customers.id=jobs.customer_id', 'inner');
        $this->db->join('users AS installer', 'installer.id=jobs.installer', 'left');
        $this->db->join('opportunities', 'opportunities.id=jobs.oppor_id', 'inner');
        $this->db->join('users AS sale_rep', 'sale_rep.id=opportunities.sale_rep', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPayamountByJobID($job_id)
    {
        $payments = $this->db->get_where('payments', array('job_id' => $job_id))->result();
        $pay_amounts = 0;
        foreach ($payments as $payment) {
            $pay_amounts += $payment->payment_amount;
        }
        return $pay_amounts;
    }

    public function getInvoiceamountByJobID($job_id)
    {
        $invoices = $this->db->get_where('invoices', array('job_id' => $job_id))->result();
        $inv_amount = 0;
        foreach ($invoices as $invoice) {
            $inv_amount += $invoice->invoice_amount;
        }
        return $inv_amount;
    }
}
