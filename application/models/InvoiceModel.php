<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class InvoiceModel extends CI_Model
{


    public function __construct()
    {

        parent::__construct();

    }

    public function getInvoicesByJobID($job_id)
    {
        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->where('job_id', $job_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function has_payment($invoice_id)
    {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('invoice_id', $invoice_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

}
