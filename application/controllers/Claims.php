<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claims extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Claim_model');
    }

    public function index() {
        $data['title'] = 'Service Claims';
        $data['claims'] = $this->Claim_model->get_all_claims();
        $this->load->view('templates/header', $data);
        $this->load->view('claims/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'New Service Claim';

        $this->form_validation->set_rules('service_name', 'Service Name', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('claims/form', $data);
            $this->load->view('templates/footer');
        } else {
            $claim_data = array(
                'service_name' => $this->input->post('service_name'),
                'patient_identifier' => $this->input->post('patient_identifier'),
                'amount' => $this->input->post('amount'),
                'status' => $this->input->post('status'),
                'created_by' => $this->session->userdata('user_id')
            );
            $this->Claim_model->create_claim($claim_data);
            redirect('claims');
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Claim';
        $data['claim'] = $this->Claim_model->get_claim($id);

        if (empty($data['claim'])) show_404();

        $this->form_validation->set_rules('service_name', 'Service Name', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('claims/form', $data);
            $this->load->view('templates/footer');
        } else {
            $claim_data = array(
                'service_name' => $this->input->post('service_name'),
                'patient_identifier' => $this->input->post('patient_identifier'),
                'amount' => $this->input->post('amount'),
                'status' => $this->input->post('status')
            );
            $this->Claim_model->update_claim($id, $claim_data);
            redirect('claims');
        }
    }

    public function delete($id) {
        $this->Claim_model->delete_claim($id);
        redirect('claims');
    }
}
