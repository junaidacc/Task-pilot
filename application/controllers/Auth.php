<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user($email);

        if ($user && password_verify($password, $user['password'])) {
            $session_data = array(
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_email' => $user['email'],
                'user_role' => $user['role'],
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
