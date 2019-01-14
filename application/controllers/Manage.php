<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $status = cleanit($this->input->get('type'));
        $page_data['page_title'] = 'Manage all products';
        $page_data['pg_name'] = 'manage_product';
        $page_data['sub_name'] = $status;
        $id = $this->session->userdata('logged_id');
        $page_data['profile'] = $this->seller->get_profile_details($id,
            'first_name,last_name,email,profile_pic');
        // get product
        $page_data['products'] = $this->seller->get_product($id, $status
        );
        $page_data['type'] = $status;
        $this->load->view('manage', $page_data);
    }

    public function stat(){
        $pid = cleanit($this->uri->segment(3));
        $id = $this->session->userdata('logged_id');
        $page_data['product'] = $this->seller->get_single_product_detail( $id, $pid );
        if( !$page_data['product']){
            redirect($_SERVER['HTTP_REFERER']);
        }
//        var_dump( $page_data['product'] );
//        exit;
        $page_data['page_title'] = 'Product Detail';
        $page_data['pg_name'] = 'product_stat';
        $page_data['sub_name'] = '';
        $id = $this->session->userdata('logged_id');
        $page_data['profile'] = $this->seller->get_profile_details($id,
            'first_name,last_name,email,profile_pic');
        $this->load->view('stat', $page_data);
    }

}
