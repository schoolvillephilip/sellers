<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends CI_Controller {
    public function __construct(){
        parent::__construct();

        $this->load->model('seller_model', 'seller');
        if( $this->session->userdata('logged_in')) {
            $user = $this->seller->get_profile( $this->session->userdata('logged_id') );
            if( $user->is_seller == 'false' ){
                $this->session->set_flashdata('success_msg','Please complete the below form to become a seller!');
                redirect('application');
            }elseif( $user->is_seller == 'pending' ){
                $this->session->set_flashdata('success_msg','Your account is under review.');
                redirect('application/status');
            }
        }else{
            redirect(base_url('login'));
        }
    }


    //FAQ
    public function index(){
        redirect('account/statement');
    }

    public function statement(){
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Account Statement";
        $page_data['sub_name'] = "statement";
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $this->load->view('statement', $page_data);
    }
    public function sales_rep(){
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Sales Report";
        $page_data['sub_name'] = "sales_rep";
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $this->load->view('sales_rep', $page_data);
    }


}
