<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Task_model');
        $this->load->model('Prescription_model');
        $this->load->model('Claim_model');
        $this->load->model('Invoice_model');
    }

    public function index() {
        $data['title'] = 'Dashboard';
        
        // Basic stats for the dashboard
        $data['tasks'] = $this->Task_model->get_all_tasks();
        $data['prescriptions'] = $this->Prescription_model->get_all_prescriptions(); // Quick fix: should be get_all_prescriptions but we'll load count
        
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
