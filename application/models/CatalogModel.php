<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CatalogModel extends CI_Model
{


    public function __construct()
    {

        parent::__construct();

    }

    public function getCatalogs()
    {
        $this->db->select('*');
        $this->db->from('product_catalogs');
        $query = $this->db->get();
        $catalogs = $query->result();
        $retAry = array();
        foreach ($catalogs as $catalog) {
            $retAry[$catalog->product_category][$catalog->sub_category][$catalog->mat_code] = array(
                    'mat_description'=>$catalog->mat_description,
                    'price_per_unit_tender'=>$catalog->price_per_unit_tender,
                    'price_per_unit_contractor'=>$catalog->price_per_unit_contractor
            );
        }
        return $retAry;
    }

    public function getProductCategories()
    {
        $this->db->select('*');
        $this->db->from('product_catalogs');
        $this->db->group_by('product_category');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_user($customer_id)
    {
        $query = $this->db->get_where('users', array('id' => $customer_id));
        return $query->row();
    }

}
