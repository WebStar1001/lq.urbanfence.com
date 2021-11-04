<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotes extends CI_Controller
{


    function __construct()
    {

        parent::__construct();

        $this->load->library('auth');
        $this->load->library('session');
        $this->auth->check_permission();
        $this->load->model('CustomerModel');
        $this->load->model('CompanyModel');
        $this->load->model('CatalogModel');
        $this->load->model('OpportunityModel');
        $this->load->model('UserModel');
        $this->load->model('QuoteModel');
    }

    public function add_quote()
    {
        $data['opportunity'] = array();
        $data['quote'] = array();
        $data['mat_info'] = array();
        $data['lab_info'] = array();
        $data['misc_info'] = array();
        $data['add_on_info'] = array();

        if (isset($_GET['opportunity_id'])) {
            $data['opportunity'] = $this->OpportunityModel->get_opportunity($_GET['opportunity_id']);
        } elseif (isset($_GET['quote_id'])) {
            $data['quote'] = $this->QuoteModel->get_quote($_GET['quote_id']);
            $data['mat_info'] = $this->QuoteModel->get_matinfo($_GET['quote_id']);
            $data['lab_info'] = $this->QuoteModel->get_labinfo($_GET['quote_id']);
            $data['misc_info'] = $this->QuoteModel->get_miscinfo($_GET['quote_id']);
            $data['add_on_info'] = $this->QuoteModel->get_add_oninfo($_GET['quote_id']);
            $data['opportunity'] = $this->OpportunityModel->get_opportunity($data['quote']->oppor_id);
        }
        $data['categories'] = $this->CatalogModel->getProductCategories();
        $data['catalogs'] = $this->CatalogModel->getCatalogs();
        $data['companies'] = $this->CompanyModel->getCompanies();
        $this->load->view('inc/header');
        $this->load->view('quotes/add_quote', $data);
        $this->load->view('inc/footer');

    }

    public function quotes_list()
    {
        $data['sales'] = $this->UserModel->getUserByAccessLevel('Sales');
        $data['companies'] = $this->CompanyModel->getCompanies();
        $this->load->view('inc/header');
        $this->load->view('quotes/view_quote', $data);
        $this->load->view('inc/footer');

    }

    public function save_quote()
    {

        $opportunity_id = $this->input->post('opportunity_id');
        $payment_term = $this->input->post('payment_term');
        $calc_mode = $this->input->post('calc_mode');
        $customer_id = $this->input->post('customer_id');
        $quote_id = $this->input->post('quote_id');

        $mat_category = $this->input->post('material_category');
        $sub_category = $this->input->post('sub_categories');

        $material_code = $this->input->post('material_code');
        $mat_quantity = $this->input->post('mat_quantity');
        $labor_type = $this->input->post('labor_type');
        $labor_total_days = $this->input->post('labor_total_days');
        $misc_desc = $this->input->post('misc_desc');
        $misc_unit_price = $this->input->post('misc_unit_price');
        $misc_quantity = $this->input->post('misc_quantity');
        $addon_desc = $this->input->post('addon_desc');
        $addon_unit_price = $this->input->post('addon_unit_price');
        $addon_quantity = $this->input->post('addon_quantity');
        $action = $this->input->post('action');

        $customer = $this->CustomerModel->get_customer($customer_id);

        $company_id = $customer->company_id;

        if ($action == 'save_new_quote') {
            $quoteData = array(
                'company_id' => $company_id,
                'customer_id' => $customer_id,
                'oppor_id' => $opportunity_id,
                'payment_term' => $payment_term,
                'calc_mode' => $calc_mode,
            );
            $quoteData['mat_net'] = $this->input->post('mat_net');
            $quoteData['mat_factor'] = $this->input->post('mat_factor');
            $quoteData['labour_net'] = $this->input->post('labour_net');
            $quoteData['lab_factor'] = $this->input->post('lab_factor');
            $quoteData['misc_net'] = $this->input->post('misc_net');
            $quoteData['misc_factor'] = $this->input->post('misc_factor');
            $quoteData['ads_on_net'] = $this->input->post('add_on_net');
            $quoteData['ads_on_factor'] = $this->input->post('ads_on_factor');
            $quoteData['discount_set'] = $this->input->post('discount_percent');
        } elseif ($action == 'submit_new_quote') {
            $quoteData = array(
                'company_id' => $company_id,
                'customer_id' => $customer_id,
                'oppor_id' => $opportunity_id,
                'payment_term' => $payment_term,
                'calc_mode' => $calc_mode,
                'status' => 'Pending'
            );
            $quoteData['mat_net'] = $this->input->post('mat_net');
            $quoteData['labour_net'] = $this->input->post('labour_net');
            $quoteData['misc_net'] = $this->input->post('misc_net');
            $quoteData['ads_on_net'] = $this->input->post('add_on_net');
            $quoteData['discount_set'] = $this->input->post('discount_percent');
        } elseif ($action == 'save_pending_quote') {
            $quoteData = array(
                'additional_col_1' => $this->input->post('additional_col_1'),
                'additional_col_2' => $this->input->post('additional_col_2'),
                'additional_col_3' => $this->input->post('additional_col_3'),
                'additional_col_4' => $this->input->post('additional_col_4'),
                'additional_col_5' => $this->input->post('additional_col_5'),
                'additional_col_6' => $this->input->post('additional_col_6'),
                'additional_col_7' => $this->input->post('additional_col_7'),
                'additional_select_1' => $this->input->post('additional_select_1'),
                'additional_select_2' => $this->input->post('additional_select_2'),
                'additional_notes' => $this->input->post('additional_notes'),
                'additional_office_notes' => $this->input->post('additional_office_notes'),
                'installation_detail_1' => $this->input->post('installation_detail_1'),
                'installation_detail_2' => $this->input->post('installation_detail_2'),
                'installation_detail_3' => $this->input->post('installation_detail_3'),
                'installation_detail_4' => $this->input->post('installation_detail_4'),
                'installation_detail_5' => $this->input->post('installation_detail_5'),
                'installation_detail_6' => $this->input->post('installation_detail_6'),
                'installation_detail_7' => $this->input->post('installation_detail_7'),
                'installation_detail_8' => $this->input->post('installation_detail_8'),
                'installation_detail_9' => $this->input->post('installation_detail_9'),
                'installation_detail_10' => $this->input->post('installation_detail_10'),
                'installation_detail_11' => $this->input->post('installation_detail_11'),
                'installation_detail_12' => $this->input->post('installation_detail_12'),
                'installation_detail_13' => $this->input->post('installation_detail_13'),
                'installation_detail_14' => $this->input->post('installation_detail_14'),
                'installation_detail_15' => $this->input->post('installation_detail_15'),
                'installation_detail_16' => $this->input->post('installation_detail_16'),
                'installation_detail_17' => $this->input->post('installation_detail_17'),
                'installation_detail_18' => $this->input->post('installation_detail_18'),
                'installation_detail_19' => $this->input->post('installation_detail_19'),
                'installation_detail_20' => $this->input->post('installation_detail_20'),
                'installation_detail_21' => $this->input->post('installation_detail_21'),
                'installation_detail_22' => $this->input->post('installation_detail_22'),
                'installation_detail_23' => $this->input->post('installation_detail_23'),
                'installation_detail_24' => $this->input->post('installation_detail_24'),
                'installation_detail_25' => $this->input->post('installation_detail_25'),
                'installation_detail_26' => $this->input->post('installation_detail_26'),
                'installation_detail_27' => $this->input->post('installation_detail_27'),
                'installation_detail_28' => $this->input->post('installation_detail_28'),
                'ia_signed' => $this->input->post('ia_signed'),
                'form_signed' => $this->input->post('form_signed'),
                'credit_passed' => $this->input->post('credit_passed')
            );
        } elseif ($action == 'submit_pending_quote') {
            $quoteData = array(
                'status' => 'Approved',
                'additional_col_1' => $this->input->post('additional_col_1'),
                'additional_col_2' => $this->input->post('additional_col_2'),
                'additional_col_3' => $this->input->post('additional_col_3'),
                'additional_col_4' => $this->input->post('additional_col_4'),
                'additional_col_5' => $this->input->post('additional_col_5'),
                'additional_col_6' => $this->input->post('additional_col_6'),
                'additional_col_7' => $this->input->post('additional_col_7'),
                'additional_select_1' => $this->input->post('additional_select_1'),
                'additional_select_2' => $this->input->post('additional_select_2'),
                'additional_notes' => $this->input->post('additional_notes'),
                'additional_office_notes' => $this->input->post('additional_office_notes'),
                'installation_detail_1' => $this->input->post('installation_detail_1'),
                'installation_detail_2' => $this->input->post('installation_detail_2'),
                'installation_detail_3' => $this->input->post('installation_detail_3'),
                'installation_detail_4' => $this->input->post('installation_detail_4'),
                'installation_detail_5' => $this->input->post('installation_detail_5'),
                'installation_detail_6' => $this->input->post('installation_detail_6'),
                'installation_detail_7' => $this->input->post('installation_detail_7'),
                'installation_detail_8' => $this->input->post('installation_detail_8'),
                'installation_detail_9' => $this->input->post('installation_detail_9'),
                'installation_detail_10' => $this->input->post('installation_detail_10'),
                'installation_detail_11' => $this->input->post('installation_detail_11'),
                'installation_detail_12' => $this->input->post('installation_detail_12'),
                'installation_detail_13' => $this->input->post('installation_detail_13'),
                'installation_detail_14' => $this->input->post('installation_detail_14'),
                'installation_detail_15' => $this->input->post('installation_detail_15'),
                'installation_detail_16' => $this->input->post('installation_detail_16'),
                'installation_detail_17' => $this->input->post('installation_detail_17'),
                'installation_detail_18' => $this->input->post('installation_detail_18'),
                'installation_detail_19' => $this->input->post('installation_detail_19'),
                'installation_detail_20' => $this->input->post('installation_detail_20'),
                'installation_detail_21' => $this->input->post('installation_detail_21'),
                'installation_detail_22' => $this->input->post('installation_detail_22'),
                'installation_detail_23' => $this->input->post('installation_detail_23'),
                'installation_detail_24' => $this->input->post('installation_detail_24'),
                'installation_detail_25' => $this->input->post('installation_detail_25'),
                'installation_detail_26' => $this->input->post('installation_detail_26'),
                'installation_detail_27' => $this->input->post('installation_detail_27'),
                'installation_detail_28' => $this->input->post('installation_detail_28'),
                'ia_signed' => $this->input->post('ia_signed'),
                'form_signed' => $this->input->post('form_signed'),
                'credit_passed' => $this->input->post('credit_passed')
            );
        } elseif ($action == 'reject_pending_quote') {
            $quoteData = array(
                'status' => 'New',
                'additional_col_1' => $this->input->post('additional_col_1'),
                'additional_col_2' => $this->input->post('additional_col_2'),
                'additional_col_3' => $this->input->post('additional_col_3'),
                'additional_col_4' => $this->input->post('additional_col_4'),
                'additional_col_5' => $this->input->post('additional_col_5'),
                'additional_col_6' => $this->input->post('additional_col_6'),
                'additional_col_7' => $this->input->post('additional_col_7'),
                'additional_select_1' => $this->input->post('additional_select_1'),
                'additional_select_2' => $this->input->post('additional_select_2'),
                'additional_notes' => $this->input->post('additional_notes'),
                'additional_office_notes' => $this->input->post('additional_office_notes'),
                'installation_detail_1' => $this->input->post('installation_detail_1'),
                'installation_detail_2' => $this->input->post('installation_detail_2'),
                'installation_detail_3' => $this->input->post('installation_detail_3'),
                'installation_detail_4' => $this->input->post('installation_detail_4'),
                'installation_detail_5' => $this->input->post('installation_detail_5'),
                'installation_detail_6' => $this->input->post('installation_detail_6'),
                'installation_detail_7' => $this->input->post('installation_detail_7'),
                'installation_detail_8' => $this->input->post('installation_detail_8'),
                'installation_detail_9' => $this->input->post('installation_detail_9'),
                'installation_detail_10' => $this->input->post('installation_detail_10'),
                'installation_detail_11' => $this->input->post('installation_detail_11'),
                'installation_detail_12' => $this->input->post('installation_detail_12'),
                'installation_detail_13' => $this->input->post('installation_detail_13'),
                'installation_detail_14' => $this->input->post('installation_detail_14'),
                'installation_detail_15' => $this->input->post('installation_detail_15'),
                'installation_detail_16' => $this->input->post('installation_detail_16'),
                'installation_detail_17' => $this->input->post('installation_detail_17'),
                'installation_detail_18' => $this->input->post('installation_detail_18'),
                'installation_detail_19' => $this->input->post('installation_detail_19'),
                'installation_detail_20' => $this->input->post('installation_detail_20'),
                'installation_detail_21' => $this->input->post('installation_detail_21'),
                'installation_detail_22' => $this->input->post('installation_detail_22'),
                'installation_detail_23' => $this->input->post('installation_detail_23'),
                'installation_detail_24' => $this->input->post('installation_detail_24'),
                'installation_detail_25' => $this->input->post('installation_detail_25'),
                'installation_detail_26' => $this->input->post('installation_detail_26'),
                'installation_detail_27' => $this->input->post('installation_detail_27'),
                'installation_detail_28' => $this->input->post('installation_detail_28'),
                'ia_signed' => $this->input->post('ia_signed'),
                'form_signed' => $this->input->post('form_signed'),
                'credit_passed' => $this->input->post('credit_passed')
            );
        } elseif ($action == 'save_approved_quote') {
            $quoteData = array(
                'installation_detail_1' => $this->input->post('installation_detail_1'),
                'installation_detail_2' => $this->input->post('installation_detail_2'),
                'installation_detail_3' => $this->input->post('installation_detail_3'),
                'installation_detail_4' => $this->input->post('installation_detail_4'),
                'installation_detail_5' => $this->input->post('installation_detail_5'),
                'installation_detail_6' => $this->input->post('installation_detail_6'),
                'installation_detail_7' => $this->input->post('installation_detail_7'),
                'installation_detail_8' => $this->input->post('installation_detail_8'),
                'installation_detail_9' => $this->input->post('installation_detail_9'),
                'installation_detail_10' => $this->input->post('installation_detail_10'),
                'installation_detail_11' => $this->input->post('installation_detail_11'),
                'installation_detail_12' => $this->input->post('installation_detail_12'),
                'installation_detail_13' => $this->input->post('installation_detail_13'),
                'installation_detail_14' => $this->input->post('installation_detail_14'),
                'installation_detail_15' => $this->input->post('installation_detail_15'),
                'installation_detail_16' => $this->input->post('installation_detail_16'),
                'installation_detail_17' => $this->input->post('installation_detail_17'),
                'installation_detail_18' => $this->input->post('installation_detail_18'),
                'installation_detail_19' => $this->input->post('installation_detail_19'),
                'installation_detail_20' => $this->input->post('installation_detail_20'),
                'installation_detail_21' => $this->input->post('installation_detail_21'),
                'installation_detail_22' => $this->input->post('installation_detail_22'),
                'installation_detail_23' => $this->input->post('installation_detail_23'),
                'installation_detail_24' => $this->input->post('installation_detail_24'),
                'installation_detail_25' => $this->input->post('installation_detail_25'),
                'installation_detail_26' => $this->input->post('installation_detail_26'),
                'installation_detail_27' => $this->input->post('installation_detail_27'),
                'installation_detail_28' => $this->input->post('installation_detail_28')
            );
        } elseif ($action == 'reject_approved_quote') {
            $quoteData = array(
                'status' => 'Pending',
                'installation_detail_1' => $this->input->post('installation_detail_1'),
                'installation_detail_2' => $this->input->post('installation_detail_2'),
                'installation_detail_3' => $this->input->post('installation_detail_3'),
                'installation_detail_4' => $this->input->post('installation_detail_4'),
                'installation_detail_5' => $this->input->post('installation_detail_5'),
                'installation_detail_6' => $this->input->post('installation_detail_6'),
                'installation_detail_7' => $this->input->post('installation_detail_7'),
                'installation_detail_8' => $this->input->post('installation_detail_8'),
                'installation_detail_9' => $this->input->post('installation_detail_9'),
                'installation_detail_10' => $this->input->post('installation_detail_10'),
                'installation_detail_11' => $this->input->post('installation_detail_11'),
                'installation_detail_12' => $this->input->post('installation_detail_12'),
                'installation_detail_13' => $this->input->post('installation_detail_13'),
                'installation_detail_14' => $this->input->post('installation_detail_14'),
                'installation_detail_15' => $this->input->post('installation_detail_15'),
                'installation_detail_16' => $this->input->post('installation_detail_16'),
                'installation_detail_17' => $this->input->post('installation_detail_17'),
                'installation_detail_18' => $this->input->post('installation_detail_18'),
                'installation_detail_19' => $this->input->post('installation_detail_19'),
                'installation_detail_20' => $this->input->post('installation_detail_20'),
                'installation_detail_21' => $this->input->post('installation_detail_21'),
                'installation_detail_22' => $this->input->post('installation_detail_22'),
                'installation_detail_23' => $this->input->post('installation_detail_23'),
                'installation_detail_24' => $this->input->post('installation_detail_24'),
                'installation_detail_25' => $this->input->post('installation_detail_25'),
                'installation_detail_26' => $this->input->post('installation_detail_26'),
                'installation_detail_27' => $this->input->post('installation_detail_27'),
                'installation_detail_28' => $this->input->post('installation_detail_28')
            );
        } elseif ($action == 'create_job') {
            $quoteData = array(
                'status' => 'Job',
                'installation_detail_1' => $this->input->post('installation_detail_1'),
                'installation_detail_2' => $this->input->post('installation_detail_2'),
                'installation_detail_3' => $this->input->post('installation_detail_3'),
                'installation_detail_4' => $this->input->post('installation_detail_4'),
                'installation_detail_5' => $this->input->post('installation_detail_5'),
                'installation_detail_6' => $this->input->post('installation_detail_6'),
                'installation_detail_7' => $this->input->post('installation_detail_7'),
                'installation_detail_8' => $this->input->post('installation_detail_8'),
                'installation_detail_9' => $this->input->post('installation_detail_9'),
                'installation_detail_10' => $this->input->post('installation_detail_10'),
                'installation_detail_11' => $this->input->post('installation_detail_11'),
                'installation_detail_12' => $this->input->post('installation_detail_12'),
                'installation_detail_13' => $this->input->post('installation_detail_13'),
                'installation_detail_14' => $this->input->post('installation_detail_14'),
                'installation_detail_15' => $this->input->post('installation_detail_15'),
                'installation_detail_16' => $this->input->post('installation_detail_16'),
                'installation_detail_17' => $this->input->post('installation_detail_17'),
                'installation_detail_18' => $this->input->post('installation_detail_18'),
                'installation_detail_19' => $this->input->post('installation_detail_19'),
                'installation_detail_20' => $this->input->post('installation_detail_20'),
                'installation_detail_21' => $this->input->post('installation_detail_21'),
                'installation_detail_22' => $this->input->post('installation_detail_22'),
                'installation_detail_23' => $this->input->post('installation_detail_23'),
                'installation_detail_24' => $this->input->post('installation_detail_24'),
                'installation_detail_25' => $this->input->post('installation_detail_25'),
                'installation_detail_26' => $this->input->post('installation_detail_26'),
                'installation_detail_27' => $this->input->post('installation_detail_27'),
                'installation_detail_28' => $this->input->post('installation_detail_28')
            );
            $quote = $this->QuoteModel->get_quote($quote_id);
            $quote_total = $quote->mat_net * $quote->mat_factor + $quote->mat_net * 0.32 + $quote->labour_net * $quote->lab_factor +
                +$quote->misc_net * $quote->misc_factor + $quote->ads_on_net * $quote->ads_on_factor;
            $discount_amount = $quote_total * $quote->discount_set / 100;
            $hst = $quote->hst;
            $jobData = array(
                'customer_id' => $customer_id,
                'oppor_id' => $opportunity_id,
                'quote_id' => $quote_id,
                'job_balance' => $quote_total - $discount_amount + $hst,
                'company_id' => $company_id
            );
            $this->db->insert('jobs', $jobData);
            $this->CustomerModel->changeCustomerStatus($customer_id, 'Customer');
        } elseif ($action == 'generate_form') {
            $quoteData = array(
                'additional_col_1' => $this->input->post('additional_col_1'),
                'additional_col_2' => $this->input->post('additional_col_2'),
                'additional_col_3' => $this->input->post('additional_col_3'),
                'additional_col_4' => $this->input->post('additional_col_4'),
                'additional_col_5' => $this->input->post('additional_col_5'),
                'additional_col_6' => $this->input->post('additional_col_6'),
                'additional_col_7' => $this->input->post('additional_col_7'),
                'additional_notes' => $this->input->post('additional_notes')
            );
            $quote = $this->QuoteModel->get_quote($quote_id);
            if ($quote->status == 'Pending') {
                $quoteData['additional_select_1'] = $this->input->post('additional_select_1');
                $quoteData['additional_select_2'] = $this->input->post('additional_select_2');
            }
        }
        if ($quote_id) {
            $this->db->where('id', $quote_id);
            $this->db->update('quotes', $quoteData);
        } else {
            $this->db->insert('quotes', $quoteData);
            $quote_id = $this->db->insert_id();

            if ($action == 'submit_pending_quote') {
                $managers = $this->UserModel->getManagersByCompanyID($company_id);

                foreach ($managers as $manager) {
                    $this->send_email_to_manager($quote_id, $opportunity_id, $manager);
                }
            }
        }
        if ($action == 'save_new_quote' || $action == 'submit_new_quote') {
            $this->db->delete('mat_details', array('quote_id' => $quote_id));
            $this->db->delete('lab_details', array('quote_id' => $quote_id));
            $this->db->delete('misc_details', array('quote_id' => $quote_id));
            $this->db->delete('add_on_details', array('quote_id' => $quote_id));
            if ($mat_category) {
                if (sizeof($mat_category) > 0) {
                    foreach ($mat_category as $key => $category) {
                        if ($category == '')
                            continue;
                        $mat_data = array(
                            'quote_id' => $quote_id,
                            'mat_category' => $category,
                            'code' => $material_code[$key],
                            'sub_category' => $sub_category[$key],
                            'quantity' => $mat_quantity[$key],
                            'company_id' => $company_id
                        );
                        $this->db->insert('mat_details', $mat_data);
                    }
                }
            }
            if ($labor_type) {
                if (sizeof($labor_type) > 0) {
                    foreach ($labor_type as $key => $type) {
                        if ($type == '')
                            continue;
                        $lab_data = array(
                            'quote_id' => $quote_id,
                            'labour_type' => $type,
                            'total_days' => $labor_total_days[$key],
                            'company_id' => $company_id
                        );
                        $this->db->insert('lab_details', $lab_data);
                    }
                }
            }
            if ($misc_desc) {
                if (sizeof($misc_desc) > 0) {
                    foreach ($misc_desc as $key => $desc) {
                        if ($desc == '')
                            continue;
                        $misc_data = array(
                            'quote_id' => $quote_id,
                            'misc_description' => $desc,
                            'quantity' => $misc_quantity[$key],
                            'price_per_unit' => $misc_unit_price[$key],
                            'company_id' => $company_id
                        );
                        $this->db->insert('misc_details', $misc_data);
                    }
                }
            }
            if ($addon_desc) {
                if (sizeof($addon_desc) > 0) {
                    foreach ($addon_desc as $key => $add_desc) {
                        if ($add_desc == '')
                            continue;
                        $addon_data = array(
                            'quote_id' => $quote_id,
                            'add_on_description' => $add_desc,
                            'quantity' => $addon_quantity[$key],
                            'net_price_per_unit' => $addon_unit_price[$key],
                            'company_id' => $company_id
                        );
                        $this->db->insert('add_on_details', $addon_data);
                    }
                }
            }
        }
        if ($action == 'generate_form') {

            $quote = $this->QuoteModel->getQuoteDatas($quote_id);

            $customer = $this->CustomerModel->get_customer($quote->customer_id);

            $this->load->view('quotes/qa_form', array('quote' => $quote, 'customer' => $customer));

            $html = $this->output->get_output();

            // Load pdf library
            $this->load->library('Pdf');

            // Load HTML content
            $this->pdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $this->pdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $this->pdf->render();

            // Output the generated PDF (1 = download and 0 = preview)
            $this->pdf->stream("welcome.pdf", array("Attachment" => 0));
            echo 'success';
            exit;
        } else {
            if ($action == 'submit_new_quote' || $action == 'reject_pending_quote') {
                redirect('/Quotes/add_quote?quote_id=' . $quote_id);
            } else {
                redirect('/Quotes/quotes_list');
            }
        }
    }

    private function send_email_to_manager($quote_id, $oppor_id, $manager)
    {
        $userEmail = $manager->username;

        $subject = 'Please note a new Quote has been submitted for approval in the system:';

        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => '1'
        );

        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");

        $this->email->from('Urbanfence');
        $this->email->to($userEmail);
        $this->email->subject($subject);

        $oppor = $this->OpportunityModel->get_opportunity($oppor_id);
        $data['manager'] = $manager->name;
        $data['quote_id'] = $quote_id;
        $data['customer'] = $oppor->customer_name;
        $data['job_type'] = $oppor->job_type;

        $body = $this->load->view('emails/to_quote_manager.php', $data, TRUE);
        $this->email->message($body);
        $this->email->send();
    }

    public function get_quotes()
    {
        $data['data'] = $this->QuoteModel->getQuoteList();
        echo json_encode($data);
    }

    public function generate_ia()
    {
        $quote_id = $_GET['quote_id'];
//        $quote_id = 2;
        $quote = $this->QuoteModel->getQuoteDatas($quote_id);
        $this->load->view('quotes/generate_ia', array('quote' => $quote));

        $html = $this->output->get_output();

        // Load pdf library
        $this->load->library('Pdf');

        // Load HTML content
        $this->pdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->pdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->pdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        $this->pdf->stream("welcome.pdf", array("Attachment" => 0));
        echo 'success';
        exit;
    }

    public function generate_qa_blank()
    {
        $quote_id = $_GET['quote_id'];

        $quote = $this->QuoteModel->getQuoteDatas($quote_id);

        $customer = $this->CustomerModel->get_customer($quote->customer_id);

        $this->load->view('quotes/qa_blank', array('quote' => $quote, 'customer' => $customer));

        $html = $this->output->get_output();

        // Load pdf library
        $this->load->library('Pdf');

        // Load HTML content
        $this->pdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $this->pdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $this->pdf->render();

        // Output the generated PDF (1 = download and 0 = preview)
        $this->pdf->stream("welcome.pdf", array("Attachment" => 0));
        echo 'success';
        exit;
    }
} 