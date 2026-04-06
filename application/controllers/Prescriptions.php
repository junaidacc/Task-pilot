<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prescriptions extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Prescription_model');
    }

    public function index() {
        $data['title'] = 'Prescriptions';
        $data['prescriptions'] = $this->Prescription_model->get_all_prescriptions();
        $this->load->view('templates/header', $data);
        $this->load->view('prescriptions/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'New Prescription Request';

        $this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
        $this->form_validation->set_rules('gp_surgery', 'GP Surgery', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('prescriptions/form', $data);
            $this->load->view('templates/footer');
        } else {
            $prescription_data = array(
                'patient_name' => $this->input->post('patient_name'),
                'gp_surgery' => $this->input->post('gp_surgery'),
                'medications' => $this->input->post('medications'),
                'status' => $this->input->post('status'),
                'requested_by' => $this->session->userdata('user_id')
            );
            $this->Prescription_model->create_prescription($prescription_data);
            redirect('prescriptions');
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Prescription Request';
        $data['prescription'] = $this->Prescription_model->get_prescription($id);

        if (empty($data['prescription'])) show_404();

        $this->form_validation->set_rules('patient_name', 'Patient Name', 'required');
        $this->form_validation->set_rules('gp_surgery', 'GP Surgery', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('prescriptions/form', $data);
            $this->load->view('templates/footer');
        } else {
            $prescription_data = array(
                'patient_name' => $this->input->post('patient_name'),
                'gp_surgery' => $this->input->post('gp_surgery'),
                'medications' => $this->input->post('medications'),
                'status' => $this->input->post('status')
            );
            $this->Prescription_model->update_prescription($id, $prescription_data);
            redirect('prescriptions');
        }
    }

    public function delete($id) {
        $this->Prescription_model->delete_prescription($id);
        redirect('prescriptions');
    }
}
