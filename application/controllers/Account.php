<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('seller_model', 'seller');
        if ($this->session->userdata('logged_in')) {
            $user = $this->seller->get_profile($this->session->userdata('logged_id'));
            if ($user->is_seller == 'false') {
                $this->session->set_flashdata('success_msg', 'Please complete the below form to become a seller!');
                redirect('application');
            } elseif ($user->is_seller == 'pending') {
                $this->session->set_flashdata('success_msg', 'Your account is under review.');
                redirect('application/status');
            }
        } else {
            redirect(base_url('login'));
        }
    }

    //FAQ
    public function index()
    {
        redirect('account/statement');
    }

    public function statement()
    {
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Account Statement";
        $page_data['sub_name'] = "statement";
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $this->load->view('statement', $page_data);
    }

    public function sales_report()
    {
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Sales Report";
        $page_data['sub_name'] = "sales_report";
        $page_data['order_chart'] = "";
        $page_data['gross_chart'] = "";
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $this->load->view('sales_report', $page_data);
    }
    public function payout()
    {
        $id = $this->session->userdata('logged_id');
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Request Payout";
        $page_data['sub_name'] = "payout";
        $page_data['profile'] = $this->seller->get_profile($id);
        if( $this->input->post() ){
            $this->form_validation->set_rules('payout_amount', 'Amount','trim|required|xss_clean');
            $this->form_validation->set_rules('payout_password', 'Password','trim|required|xss_clean');
            if( $this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error_msg', validation_errors());
                redirect('account/payout/');
            }
            // confirm password
            $amount = $this->input->post('payout_amount', true);
            $password = $this->input->post('payout_password', true);
            if( $this->seller->cur_pass_match($password , $id)){
                // check if the balance does not exeeds
                if( $amount > $page_data['profile']->balance ){
                    $this->session->set_flashdata('error_msg', 'You can not request more than available balance.');
                    redirect('account/payout/');
                }
                // Generate code
                $data['code'] = $code = $this->user->generate_code( 'users', 'code');
            }
            $this->session->set_flashdata('error_msg', 'You can not request more than available balance.');
            redirect('account/payout/');
        }else{
            $this->load->view('payout', $page_data);
        }

    }

    public function txn_overview()
    {
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Transaction Overview";
        $page_data['sub_name'] = "statement";
        $page_data['txn_chart'] = "";
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $this->load->view('txn_overview', $page_data);
    }
}
