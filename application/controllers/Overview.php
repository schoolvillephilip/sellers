<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $status = cleanit($this->uri->segment(2));
        $uid = $this->session->userdata('logged_id');
        $page_data['page_title'] = 'Seller Dashboard';
        $page_data['pg_name'] = 'overview';
        $page_data['sub_name'] = $status;
        $page_data['profile'] = $this->seller->get_profile_details($uid,
            'first_name,last_name,email,profile_pic');
        $page_data['completed_orders'] = $this->seller->get_row('orders', "COUNT(*) as total", " (seller_id = {$uid} AND active_status = 'completed') ");
        $page_data['other_orders'] = $this->seller->get_row('orders', "COUNT(*) as total", " (seller_id = {$uid} AND active_status != 'completed') ");
        $page_data['dispute'] = $this->seller->get_row('orders', "COUNT(*) as total", " (seller_id = {$uid} AND (active_status = 'returned') ) ");
        $page_data['top_views'] = $this->seller->run_sql("SELECT product_name, views FROM products WHERE seller_id = {$uid} ORDER BY views DESC LIMIT 3")->result();
//        $page_data['sales_chart'] = $this->seller->run_sql("SELECT COUNT(*) sales, DATE_FORMAT(order_date,'%Y-%m') omonth
//          FROM orders o WHERE o.seller_id = {$uid} AND o.payment_made = 'success' GROUP BY omonth ORDER BY omonth DESC LIMIT 4")->result();
        $page_data['orders'] = $this->seller->run_sql("SELECT o.order_code, o.qty, o.product_id, o.amount, o.order_date, p.product_name FROM orders o LEFT JOIN products p ON (p.id = o.product_id) WHERE o.seller_id = {$uid} GROUP BY o.order_code ORDER BY o.id DESC LIMIT 100")->result();
//        $page_data['sales'] = $this->seller->get_row('orders', " MIN(amount) as min_sale, MAX(amount) as max_sale, SUM(amount) as total_amount ", "( seller_id = {$uid}) ");
        $page_data['sales'] = $this->seller->run_sql("SELECT MIN(amount) as min_sale, MAX(amount) as max_sale, SUM(amount) as total_amount FROM orders WHERE seller_id = {$uid} AND payment_made = 'success'")->row();
        $this->load->view('dashboard', $page_data);
    }
}
