<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bugs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Bug_model');
    }

    public function index() {
        $data['title'] = 'System Bugs / Notes';
        $data['bugs'] = $this->Bug_model->get_all_bugs();
        $this->load->view('templates/header', $data);
        $this->load->view('bugs/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Report Bug / Note';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('bugs/form', $data);
            $this->load->view('templates/footer');
        } else {
            $bug_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status' => $this->input->post('status'),
                'reported_by' => $this->session->userdata('user_id')
            );
            $this->Bug_model->create_bug($bug_data);
            redirect('bugs');
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Bug / Note';
        $data['bug'] = $this->Bug_model->get_bug($id);

        if (empty($data['bug'])) show_404();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('bugs/form', $data);
            $this->load->view('templates/footer');
        } else {
            $bug_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status' => $this->input->post('status')
            );
            $this->Bug_model->update_bug($id, $bug_data);
            redirect('bugs');
        }
    }

    public function delete($id) {
        $this->Bug_model->delete_bug($id);
        redirect('bugs');
    }
}
