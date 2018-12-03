<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('seller_model', 'seller');
//        $this->session->set_userdata('referred_from', current_url());
        if( !$this->session->userdata('logged_in') ){
            // Ursher the person to where he is coming from
            $from = $this->session->userdata('referred_from');
            if( !empty( $from ) ) redirect($from);
            redirect('login');
        }
        // $this->output->enable_profiler(TRUE);

        $user = $this->seller->get_profile( $this->session->userdata('logged_id'));
        if( $user->is_seller == 'false' ){
            $this->session->set_flashdata('success_msg','Please complete the below form to become a seller!');
            redirect('seller/application');
        }elseif( $user->is_seller == 'pending'){
            $this->session->set_flashdata('success_msg','Your account is under review.');
            redirect('application/status');
        } 
    }
    
    public function index(){
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $page_data['page_title'] = 'Help and Guidelines';
        $page_data['pg_name'] = 'help';
        $page_data['sub_name'] = '';
        $this->load->view('help', $page_data);

    }

}
