<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PaymentModel extends CI_Model
{


    public function __construct()
    {

        parent::__construct();

    }

    public function getPaymentByInvoiceID($invoice_id)
    {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('invoice_id', $invoice_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getPaymentByInvoiceDate($job_id, $current_invoice_date, $next_invoice_date){
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('job_id', $job_id);
        $this->db->where('created_at >=', $current_invoice_date);
        $this->db->where('created_at <=', $next_invoice_date);
        $query = $this->db->get();
        return $query->result();
    }
}
