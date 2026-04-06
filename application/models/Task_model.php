<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_tasks() {
        $this->db->select('tasks.*, users.name as assigned_name');
        $this->db->from('tasks');
        $this->db->join('users', 'users.id = tasks.assigned_to', 'left');
        $this->db->order_by('tasks.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_task($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('tasks');
        return $query->row_array();
    }

    public function create_task($data) {
        return $this->db->insert('tasks', $data);
    }

    public function update_task($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tasks', $data);
    }

    public function delete_task($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tasks');
    }
}
