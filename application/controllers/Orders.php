<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $id = $this->session->userdata('logged_id');
        $status = cleanit($this->input->get('type'));
        $page_data['page_title'] = 'Manage all orders - ' . lang('app_name');
        $page_data['pg_name'] = 'orders';
        $page_data['sub_name'] = 'order_' . $status;
        $page_data['profile'] = $this->seller->get_profile_details($id,
            'first_name,last_name,email,profile_pic');
        $page = isset($_GET['page']) ? xss_clean($_GET['page']) : 0;
        if ($page > 1) $page -= 1;

        $array = array('is_limit' => false);
        $x = (array)$this->seller->get_orders($id, $status, $array);
        $count = (count($x));
        $this->load->library('pagination');
        $this->config->load('pagination');
        $config = $this->config->item('pagination');
        $config['base_url'] = current_url();
        $config['total_rows'] = $count;
        $config['per_page'] = 100;
        $config["num_links"] = 5;
        $this->pagination->initialize($config);
        $array['limit'] = $config['per_page'];
        $array['offset'] = $page;
        $array['is_limit'] = true;
        $page_data['pagination'] = $this->pagination->create_links();

        $page_data['orders'] = $this->seller->get_orders($id, $status, $array);
//        var_dump( $page_data['orders'] );

        $this->load->view('orders', $page_data);
    }
}
