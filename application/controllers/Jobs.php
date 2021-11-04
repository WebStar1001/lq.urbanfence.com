<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends CI_Controller
{
    function __construct()
    {

        parent::__construct();

        $this->load->library('auth');
        $this->load->library('session');
        $this->auth->check_permission();

        $this->load->model('UserModel');
        $this->load->model('JobModel');
        $this->load->model('OpportunityModel');
        $this->load->model('CustomerModel');
        $this->load->model('QuoteModel');
        $this->load->model('InvoiceModel');
        $this->load->model('PaymentModel');
        $this->load->model('CompanyModel');
    }

    public function jobs_list()
    {
        $data['sales'] = $this->UserModel->getUserByAccessLevel('Sales');
        $data['installers'] = $this->UserModel->getUserByAccessLevel('User');
        $data['companies'] = $this->CompanyModel->getCompanies();
        $this->load->view('inc/header');
        $this->load->view('jobs/view_job', $data);
        $this->load->view('inc/footer');
    }

    public function job_detail()
    {
        $job_id = '';
        $customer = '';
        $opportunity = '';
        $job = '';
        $quote = '';
        $mat_info = '';
        $pay_amount = 0;
        $invoice_amount = 0;
        if (isset($_GET['job_id'])) {
            $job_id = $_GET['job_id'];
            $job = $this->JobModel->getJobByJobID($job_id);
            if (is_object($job)) {
                $opportunity = $this->OpportunityModel->get_opportunity($job->oppor_id);
                $customer = $this->CustomerModel->get_customer($job->customer_id);
                $quote = $this->QuoteModel->get_quote($job->quote_id);
                $mat_info = $this->QuoteModel->get_matinfo($job->quote_id);
                $pay_amount = $pay_amounts = $this->JobModel->getPayamountByJobID($job_id);
                $invoice_amount = $pay_amounts = $this->JobModel->getInvoiceamountByJobID($job_id);
            }
        }
        $data = array('job' => $job, 'oppor' => $opportunity, 'customer' => $customer, 'quote' => $quote,
            'mat_info' => $mat_info, 'pay_amount' => $pay_amount, 'invoice_amount' => $invoice_amount);
        $data['installers'] = $this->UserModel->getUserByAccessLevel('User');
        $this->load->view('inc/header');
        $this->load->view('jobs/job_detail', $data);
        $this->load->view('inc/footer');
    }

    public function get_jobs()
    {
        $jobs = $this->JobModel->getJobs();
        $retAry = array();
        for ($i = 0; $i < count($jobs); $i++) {

            $total_pay_amount = $this->JobModel->getPayamountByJobID($jobs[$i]['id']);
            $retAry[$i] = $jobs[$i];
            $retAry[$i]['job_total'] = $jobs[$i]['job_balance'];
            $retAry[$i]['job_balance'] = round($jobs[$i]['job_balance'] * 1 - $total_pay_amount * 1, 2);
        }
        $data['data'] = $retAry;
        echo json_encode($data);
    }

    function search_job()
    {
        $job_id = $this->input->get('job_id');
        $job = $this->JobModel->getJobByJobID($job_id);
        $opportunity = $this->OpportunityModel->get_opportunity($job->oppor_id);
        $customer = $this->CustomerModel->get_customer($job->customer_id);
        $retAry = array('job' => $job, 'oppor' => $opportunity, 'customer' => $customer);
        echo json_encode($retAry);
    }

    public function set_mat_collect()
    {
        $mat_ids = $this->input->post('mat_id');
        $item_collects = $this->input->post('collected_quantity');
        $job_id = $this->input->post('job_id');
        $mat_item_status = 'MAT Collected';
        for ($i = 0; $i < count($mat_ids); $i++) {
            $matRow = $this->db->get_where('mat_details', array('id' => $mat_ids[$i]))->row();
            if (!is_object($matRow))
                continue;
            $this->db->where('id', $mat_ids[$i]);
            $this->db->update('mat_details', array('items_collected_for_job' => $item_collects[$i]));
            if ($matRow->quantity > $item_collects[$i]) {
                $mat_item_status = 'MAT Missing in Stock';
            }
        }
        $this->db->where('id', $job_id);
        $this->db->update('jobs', array('status' => $mat_item_status));

        redirect('Jobs/job_detail?job_id=' . $job_id);
    }

    public function set_job_settings()
    {
        $job_id = $this->input->post('job_id');
        $start_date = $this->input->post('start_date');
        $installer = $this->input->post('installer');
        $end_date = $this->input->post('end_date');
        $status = 'New';
        if ($start_date) {
            $status = 'In progress';
        }
        if ($end_date) {
            $status = 'Completed';
        }

        if ($installer) {
            $this->send_email_to_installer($job_id, $installer);
        }

        $this->db->where('id', $job_id);
        $this->db->update('jobs', array('start_date' => $start_date, 'end_date' => $end_date,
            'installer' => $installer, 'status' => $status));
        echo $status;
    }

    private function send_email_to_installer($job_id, $installer_id)
    {
        $installer = $this->UserModel->get_user($installer_id);

        $userEmail = $installer->username;

        $subject = 'You have a new job assigned to you';

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

        $data['job_id'] = $job_id;

        $job = $this->JobModel->getJobByJobID($job_id);

        $oppor = $this->OpportunityModel->get_opportunity($job->oppor_id);

        $data['customer'] = $oppor->customer_name;

        $data['installer'] = $installer->name;

        $data['job_type'] = $oppor->job_type;

        $body = $this->load->view('emails/assigned_installer.php', $data, TRUE);

        $this->email->message($body);
        $this->email->send();
    }

    public function create_payment()
    {
        $job_id = $this->input->post('job_id');
        $customer_id = $this->input->post('customer_id');
        $invoice_number = $this->input->post('invoice_number');
        $payment_amount = $this->input->post('payment_amount');
        $payment_method = $this->input->post('payment_method');
        $reference = $this->input->post('reference');
        $date = date('Y-m-d');
        $this->db->insert('payments', array(
            'job_id' => $job_id,
            'invoice_id' => $invoice_number,
            'customer_id' => $customer_id,
            'payment_amount' => $payment_amount,
            'payment_date' => $date,
            'payment_method' => $payment_method,
            'reference' => $reference
        ));
        $job = $this->JobModel->getJobByJobID($job_id);

        $pay_amounts = $this->JobModel->getPayamountByJobID($job_id);

        if ($job->job_balance <= $pay_amounts) {
            $this->db->where('id', $job_id);
            $this->db->update('jobs', array('status' => 'Completed and Paid'));
            echo 'Completed and Paid';
        } else {
            echo 'not_completed_paid';
        }

    }

    public function generate_invoice()
    {
        $job_id = $this->input->post('job_id');
        $invoice_id = $this->input->post('invoice_id');
        $customer_id = $this->input->post('customer_id');
        $company_id = $this->input->post('company_id');
        $invoice_amount = $this->input->post('invoice_amount');
        $invoice_due_date = $this->input->post('invoice_due_date');
//        $date = date('Y-m-d');
        $this->db->insert('invoices', array(
            'id' => $invoice_id,
            'job_id' => $job_id,
            'company_id' => $company_id,
            'customer_id' => $customer_id,
            'invoice_amount' => $invoice_amount,
            'due_date' => date('Y-m-d', strtotime($invoice_due_date))
        ));
        echo $this->db->insert_id();
    }

    public function credits_debits_tracking()
    {
        $job_id = $this->input->get('job_id');
        $job = $this->JobModel->getJobByJobID($job_id);
        $invoices = $this->InvoiceModel->getInvoicesByJobID($job_id);
        $retAry = array();
        $i = 0;
        $job_balance = $job->job_balance;
        $k = 0;
        $invoice_total = 0;
        foreach ($invoices as $inv) {
            $j = $i + 1;
            $l = $k + 1;

            $total_pay_amount = 0;
            $invoice_total += $inv->invoice_amount;
            $current_invoice_date = $invoices[$k]->created_at;
            $next_invoice_date = (isset($invoices[$l])) ? $invoices[$l]->created_at : '2099-12-31';

            $retAry[$i]['invoice_id'] = $inv->id;
            $retAry[$i]['payment_id'] = '';
            $retAry[$i]['debit'] = $inv->invoice_amount;
            $retAry[$i]['credit'] = '';
            $retAry[$i]['job_balance'] = round($job_balance, 2);
            $retAry[$i]['account_balance'] = $invoice_total;
            $retAry[$i]['due_date'] = $inv->due_date;
            $retAry[$i]['has_payment'] = $this->InvoiceModel->has_payment($inv->id);
            $retAry[$i]['type'] = 'invoice';
            $payments = $this->PaymentModel->getPaymentByInvoiceDate($job_id, $current_invoice_date, $next_invoice_date);
            foreach ($payments as $pay) {
                $retAry[$j]['invoice_id'] = $pay->invoice_id;
                $retAry[$j]['payment_id'] = $pay->id;
                $retAry[$j]['debit'] = '';
                $retAry[$j]['credit'] = $pay->payment_amount;
                $retAry[$j]['due_date'] = '';
                $retAry[$j]['job_balance'] = (($job_balance - $pay->payment_amount) >= 0) ? round($job_balance - $pay->payment_amount, 2) : 0;
                $retAry[$j]['account_balance'] = (($invoice_total - $pay->payment_amount) >= 0) ? ($invoice_total - $pay->payment_amount) : 0;
                $retAry[$j]['payment_method'] = $pay->payment_method;
                $retAry[$j]['payment_date'] = date('Y-m-d', strtotime($pay->payment_date));
                $retAry[$j]['notes'] = '';
                $retAry[$j]['type'] = 'payment';
                $total_pay_amount += $pay->payment_amount;
                $job_balance -= $pay->payment_amount;
                $invoice_total -= $pay->payment_amount;
                if (round($job_balance, 2) <= 0) {
                    $retAry[$j]['notes'] = '<span style="color:green;">Job Paid Fully</span>';
                }
                $j++;
            }
            $retAry[$i]['notes'] = '';
            if ($inv->due_date < date('Y-m-d')) {
                $retAry[$i]['notes'] = '<span style="color:red;">Invoice Past Due</span>';
            }
            $i = $j;
            $k++;
        }
        $data['data'] = $retAry;
        echo json_encode($data);
    }

    public function cancel_payment()
    {
        $payment_id = $this->input->post('payment_id');
        $job_id = $this->input->post('job_id');
        $this->db->where('id', $payment_id);
        $this->db->update('payments', array('payment_amount' => 0));

        $job = $this->JobModel->getJobByJobID($job_id);

        $pay_amounts = $this->JobModel->getPayamountByJobID($job_id);

        if ($job->job_balance <= $pay_amounts) {
            $this->db->where('id', $job_id);
            $this->db->update('jobs', array('status' => 'Completed and Paid'));
            echo 'Completed and Paid';
        }
    }
    public function cancel_invoice()
    {
        $invoice_id = $this->input->post('invoice_id');

        $this->db->where('id', $invoice_id);
        $this->db->delete('invoices');
        echo $invoice_id;
    }

    public function check_available_invoice()
    {
        $invoice_id = $this->input->post('invoice_number');
        $job_id = $this->input->post('job_id');
        $invoice = $this->db->get_where('invoices', array('id' => $invoice_id))->row();
        if (is_object($invoice)) {
            echo 'exist';
        } else {
            echo 'not_exist';
        }
    }

}

