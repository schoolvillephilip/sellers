<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        // @todo
        parent::__construct();
        $this->load->model('seller_model', 'seller');
        if ($this->session->userdata('logged_in')) {
            if( $this->session->userdata('seller_status') == 'false'){
                $this->session->userdata('error_msg', 'Please fill in the application form to proceed');
                redirect('temp');
            }elseif( $this->session->userdata('seller_status') == 'pending' ){
                redirect('temp/status');
            }
        }
    }

    public function index()
    {
        $page_data['page_title'] = 'Register to be part of the community';
        $page_data['pg_name'] = 'regintro';
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');
        $this->load->view('introduction', $page_data);
    }


    public function create()
    {
        $page_data['page_title'] = 'Register to be part of the community';
        $page_data['pg_name'] = 'regintro';
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');
        // $this->output->enable_profiler(TRUE);
        if( $this->input->post() ){
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|valid_email|is_unique[users.email]',
                array('is_unique' => 'Sorry! This %s has already been registered! Login to your account to proceed'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[8]|max_length[15]');
            $this->form_validation->set_rules('confirm_password', 'Password', 'trim|required|xss_clean|min_length[8]|max_length[15]|matches[password]');
            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error_msg', validation_errors());
                $page_data['title'] = "Create Account";
                $page_data['page'] = 'create';
                redirect( 'register/create');
            } else {
                $salt = salt(50);
                $data = array(
                    'first_name' => $this->input->post('first_name', true),
                    'last_name' => $this->input->post('last_name', true),
                    'email' => $this->input->post('email', true),
                    'phone' => $this->input->post('phone', true),
                    'salt' => $salt,
                    'password' => shaPassword($this->input->post('password'), $salt),
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'date_registered' => get_now(),
                    'last_login' => get_now(),
                    'is_seller' => 'false'
                );

                $user_id = $this->seller->create_account($data, 'users');
                if (!is_numeric($user_id)) {
                    $this->session->set_flashdata('error_msg', 'Sorry! There was an error creating your account.' );
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->load->model('email_model', 'email');
                    $email_array = array(
                        'email' => $data['email'],
                        'recipent' => 'Dear ' . $data['first_name'] . ' ' . $data['last_name']
                    );

                    try {
                        $this->email->welcome_buyer($email_array);
                    } catch (Exception $e) {
                        $error_action = array(
                            'error_action' => 'Create controller - Welcome mail',
                            'error_message' => $e->getMessage()
                        );
                        $this->user->create_account($error_action, 'error_logs');
                    }

                    $data = array(
                        'email' => $this->input->post('email'),
                        'password' => $this->input->post('password')
                    );
                    $user = $this->seller->login($data);
                    $session_data = array('logged_in' => true, 'logged_id' => $user->id, 'is_seller' => 'false', 'email' => $this->input->post('email'));
                    $this->session->set_userdata($session_data);
                    unset($session_data);
                    unset($data);
                    unset($error_action);
                    $this->session->set_flashdata('success_msg', "Account created and you're logged in successfully, please fill the form to proceed");
                    // To ursher them to where they are coming from...
                    redirect('temp');
                }
            }
        }else{
            $this->load->view('create_account', $page_data);
        }
    }


}
