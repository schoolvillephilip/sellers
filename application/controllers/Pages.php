<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }


    //FAQ
    public function index(){
        redirect('pages/faq');
    }

    public function faq(){
        $page_data['page'] = 'faq';
        $page_data['title'] = "Sellers FAQ";
        $this->load->view('faq', $page_data);
    }


}
