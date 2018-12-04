<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('seller_model', 'seller');
        if ($this->session->userdata('logged_in')) {
            $from = $this->session->userdata('referred_from');
            if (!empty($from)) redirect($from);
            redirect(base_url());
        }
    }

    public function index()
    {
        $page_data['page_title'] = 'Reset your password';
        $page_data['pg_name'] = 'reset';
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');
        $this->load->view('reset', $page_data);
    }

    /*
     * @Incoming : accepts the sign up POST parameters
     * result : string (success | error )
     * */
    function process()
    {

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|valid_email');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error_msg', '<strong>Please the error</strong> <br />' . validation_errors());
            redirect('reset');
        } else {
            // Check if email address is in the system
            $email = $this->input->post('email');
            $user = $this->seller->get_row('users', 'id', "( email = '$email' ) ");
        }
    }
}
