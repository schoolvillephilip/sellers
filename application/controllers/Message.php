<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $page_data['page_title'] = 'My Messages';
        $page_data['pg_name'] = 'message';
        $page_data['sub_name'] = 'message';
        $page_data['profile'] = $this->seller->get_profile_details($this->session->userdata('logged_id'),
            'first_name,last_name,email,profile_pic');
        $page_data['messages'] = $this->seller->get_message($this->session->userdata('logged_id'));
        $this->load->view('message', $page_data);
    }

    function message_detail()
    {
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
        $mid = $this->input->post('mid');
        $result = $this->seller->get_message($this->session->userdata('logged_id'), '', $mid);
        $output = array();
        $output['title'] = $result['title'];
        $output['content'] = $result['content'];
        $output['created_on'] = neatDate($result['created_on']);
        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        exit;

    }
}
