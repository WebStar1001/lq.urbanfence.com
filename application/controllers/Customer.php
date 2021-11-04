<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    function __construct()
    {

        parent::__construct();

        $this->load->library('auth');
        $this->load->library('session');
        $this->auth->check_permission();
        $this->load->model('CustomerModel');
        $this->load->model('UserModel');
        $this->load->model('CompanyModel');
    }

    public function customers_list()
    {

        $data['users'] = $this->UserModel->getUsers();
        $data['companies'] = $this->CompanyModel->getCompanies();
        $this->load->view('inc/header');
        $this->load->view('customers/view_customer', $data);
        $this->load->view('inc/footer');
    }

    public function get_customers()
    {
        $customers = $this->CustomerModel->getCustomers();

        $last_job_type_filter = $this->input->get('last_job_type');
        $last_sale_rep_filter = $this->input->get('last_sale_rep');
        $last_quote_id_filter = $this->input->get('last_quote_id');
        $retAry = array();

        foreach ($customers as $customer) {
            $last_job = $this->CustomerModel->getLastJob($customer->id);
            $last_quote = $this->CustomerModel->getLastQuote($customer->id);
            if ($last_job_type_filter) {
                if ($last_job) {
                    if ($last_job_type_filter != $last_job->job_type) {
                        continue;
                    }
                } else {
                    continue;
                }
            }
            if ($last_sale_rep_filter) {
                if ($last_job) {
                    if ($last_sale_rep_filter != $last_job->sale_rep) {
                        continue;
                    }
                } else {
                    continue;
                }
            }
            if ($last_quote_id_filter) {
                if ($last_quote) {
                    if ($last_quote_id_filter != $last_quote->id) {
                        continue;
                    }
                } else {
                    continue;
                }
            }
            if ($last_job) {
                $customer->last_job_type = $last_job->job_type;
                $customer->last_oppor_id = $last_job->id;
            } else {
                $customer->last_job_type = '';
                $customer->last_oppor_id = '';
            }
            if ($last_quote) {
                $customer->last_quote_id = $last_quote->id;
            } else {
                $customer->last_quote_id = '';
            }
            $retAry[] = $customer;
        }
        $data['data'] = $retAry;
        echo json_encode($data);
    }

    function changeCustomerStatusForJob($customer_id)
    {
        $this->db->where('id', $customer_id);
        $this->db->update('customers', array('status' => 'Customer'));
        return $customer_id;
    }

}
