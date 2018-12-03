<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('seller_model', 'seller');
    }
    
    public function index(){
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $page_data['page_title'] = 'Help and Guidelines';
        $page_data['pg_name'] = 'help';
        $page_data['sub_name'] = '';
        $this->load->view('help', $page_data);
    }

}
