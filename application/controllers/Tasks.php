<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Task_model');
        $this->load->model('User_model');
    }

    public function index() {
        $data['title'] = 'Tasks';
        $data['tasks'] = $this->Task_model->get_all_tasks();
        $this->load->view('templates/header', $data);
        $this->load->view('tasks/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Create Task';
        $data['staff'] = $this->User_model->get_all_staff();

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('tasks/form', $data);
            $this->load->view('templates/footer');
        } else {
            $task_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'assigned_to' => $this->input->post('assigned_to') ? $this->input->post('assigned_to') : NULL,
                'status' => $this->input->post('status')
            );
            $this->Task_model->create_task($task_data);
            redirect('tasks');
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Task';
        $data['task'] = $this->Task_model->get_task($id);
        $data['staff'] = $this->User_model->get_all_staff();

        if (empty($data['task'])) show_404();

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('tasks/form', $data);
            $this->load->view('templates/footer');
        } else {
            $task_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'assigned_to' => $this->input->post('assigned_to') ? $this->input->post('assigned_to') : NULL,
                'status' => $this->input->post('status')
            );
            $this->Task_model->update_task($id, $task_data);
            redirect('tasks');
        }
    }

    public function delete($id) {
        $this->Task_model->delete_task($id);
        redirect('tasks');
    }
}
