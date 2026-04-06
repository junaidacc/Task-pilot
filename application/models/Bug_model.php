<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bug_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_bugs() {
        $this->db->select('bugs.*, users.name as reported_by_name');
        $this->db->from('bugs');
        $this->db->join('users', 'users.id = bugs.reported_by', 'left');
        $this->db->order_by('bugs.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_bug($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bugs');
        return $query->row_array();
    }

    public function create_bug($data) {
        return $this->db->insert('bugs', $data);
    }

    public function update_bug($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('bugs', $data);
    }

    public function delete_bug($id) {
        $this->db->where('id', $id);
        return $this->db->delete('bugs');
    }
}
