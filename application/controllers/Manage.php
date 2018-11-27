<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('seller_model', 'seller');
        if( !$this->session->userdata('logged_in') ){
            // Ursher the person to where he is coming from            
            redirect('login');
        }
        $user = $this->seller->get_profile( $this->session->userdata('logged_id') );
        if( $user->is_seller == 'false' ){
            $this->session->set_flashdata('success_msg','Please complete the below form to become a seller!');
            redirect('application');
        }elseif( $user->is_seller == 'pending'){
            $this->session->set_flashdata('success_msg','Your account is under review.');
            redirect('application/status');
        }         
    }

    public function index(){
        $status = cleanit($this->input->get('type'));        
        $page_data['page_title'] = 'Manage all products';
        $page_data['pg_name'] = 'manage_product';
        $page_data['sub_name'] = $status;
        $page_data['profile'] = $this->seller->get_profile_details($this->session->userdata('logged_id'),
            'first_name,last_name,email,profile_pic');
        // get product
        $page_data['products'] = $this->seller->get_product( $this->session->userdata('logged_id'), $status
            );
        $page_data['type'] = $status;
        $this->load->view('manage', $page_data);
    }

}
