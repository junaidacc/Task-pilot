<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prescription_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_prescriptions() {
        $this->db->select('prescriptions.*, users.name as requested_by_name');
        $this->db->from('prescriptions');
        $this->db->join('users', 'users.id = prescriptions.requested_by', 'left');
        $this->db->order_by('prescriptions.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_prescription($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('prescriptions');
        return $query->row_array();
    }

    public function create_prescription($data) {
        return $this->db->insert('prescriptions', $data);
    }

    public function update_prescription($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('prescriptions', $data);
    }

    public function delete_prescription($id) {
        $this->db->where('id', $id);
        return $this->db->delete('prescriptions');
    }
}
