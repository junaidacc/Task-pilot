<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function get_user_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function get_all_staff() {
        $this->db->select('id, name, email, role');
        $this->db->where('role', 'staff');
        $query = $this->db->get('users');
        return $query->result_array();
    }
}
