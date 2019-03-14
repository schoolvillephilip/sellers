<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect("/");
    }
    public function brand()
    {
        $page_data['page_title'] = 'Request New Brand';
        $page_data['pg_name'] = 'request';
        $page_data['sub_name'] = 'brand';
        $page_data['profile'] = $this->seller->get_profile_details($this->session->userdata('logged_id'),
            'first_name,last_name,email,profile_pic');
        $page_data['categories'] = $this->seller->get_results('categories');
        $this->load->view('add_brand', $page_data);
    }
}
