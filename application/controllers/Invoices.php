<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Invoice_model');
    }

    public function index() {
        $data['title'] = 'Invoices';
        $data['invoices'] = $this->Invoice_model->get_all_invoices();
        $this->load->view('templates/header', $data);
        $this->load->view('invoices/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Add Invoice';

        $this->form_validation->set_rules('invoice_number', 'Invoice Number', 'required');
        $this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
        $this->form_validation->set_rules('total_amount', 'Total Amount', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('invoices/form', $data);
            $this->load->view('templates/footer');
        } else {
            $invoice_data = array(
                'invoice_number' => $this->input->post('invoice_number'),
                'supplier_name' => $this->input->post('supplier_name'),
                'total_amount' => $this->input->post('total_amount'),
                'status' => 'Pending Verification'
            );
            $this->Invoice_model->create_invoice($invoice_data);
            redirect('invoices');
        }
    }

    public function verify($id) {
        $data = array(
            'status' => 'Checked',
            'checked_by' => $this->session->userdata('user_id'),
            'checked_at' => date('Y-m-d H:i:s')
        );
        $this->Invoice_model->update_invoice($id, $data);
        $this->session->set_flashdata('success', 'Invoice marked as checked.');
        redirect('invoices');
    }

    public function delete($id) {
        $this->Invoice_model->delete_invoice($id);
        redirect('invoices');
    }
}
