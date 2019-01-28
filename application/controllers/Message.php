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

    public function questions()
    {
        $page_data['page_title'] = 'Customer Questions';
        $page_data['pg_name'] = 'questions';
        $page_data['sub_name'] = 'questions';
        $page_data['profile'] = $this->seller->get_profile_details($this->session->userdata('logged_id'),
            'first_name,last_name,email,profile_pic');
        $page_data['questions'] = $this->seller->get_message($this->session->userdata('logged_id'));
        $this->load->view('questions', $page_data);
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

    function message_action(){
        if( !$this->input->is_ajax_request() ){
            redirect(base_url());
        }else{
            $messages = $this->input->post('message');
            $action = $this->input->post('action');
            switch ($action) {
                case 'read':
                    foreach( $messages as $key => $value ){
                        $this->seller->update_data(array('id' => $key ), array('is_read' => 1 ), 'sellers_notification_message');
                    }
                    echo json_encode( array('status' => 'success'));
                    exit;
                    break;
                case 'unread':
                    foreach( $messages as $key => $value ){
                        $this->seller->update_data(array('id' => $key ), array('is_read' => 0 ), 'sellers_notification_message');
                    }
                    echo json_encode( array('status' => 'success'));
                    exit;
                case 'delete':
                    foreach( $messages as $key => $value ){
                        $this->seller->delete_table($key,'sellers_notification_message');
                    }
                    echo json_encode( array('status' => 'success'));
                    exit;
                default:
                    redirect(base_url());
                    break;

            }
        }
    }
}
