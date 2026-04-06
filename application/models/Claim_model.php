<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claim_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_claims() {
        $this->db->select('claims.*, users.name as created_by_name');
        $this->db->from('claims');
        $this->db->join('users', 'users.id = claims.created_by', 'left');
        $this->db->order_by('claims.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_claim($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('claims');
        return $query->row_array();
    }

    public function create_claim($data) {
        return $this->db->insert('claims', $data);
    }

    public function update_claim($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('claims', $data);
    }

    public function delete_claim($id) {
        $this->db->where('id', $id);
        return $this->db->delete('claims');
    }
}
