<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_invoices() {
        $this->db->select('invoices.*, users.name as checked_by_name');
        $this->db->from('invoices');
        $this->db->join('users', 'users.id = invoices.checked_by', 'left');
        $this->db->order_by('invoices.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_invoice($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('invoices');
        return $query->row_array();
    }

    public function create_invoice($data) {
        return $this->db->insert('invoices', $data);
    }

    public function update_invoice($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('invoices', $data);
    }

    public function delete_invoice($id) {
        $this->db->where('id', $id);
        return $this->db->delete('invoices');
    }
}
