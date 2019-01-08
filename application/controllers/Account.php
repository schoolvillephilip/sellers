<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('seller_model', 'seller');
        if ($this->session->userdata('logged_in')) {
            $user = $this->seller->get_profile($this->session->userdata('logged_id'));
            if ($user->is_seller == 'false') {
                $this->session->set_flashdata('success_msg', 'Please complete the below form to become a seller!');
                redirect('application');
            } elseif ($user->is_seller == 'pending') {
                $this->session->set_flashdata('success_msg', 'Your account is under review.');
                redirect('application/status');
            }
        } else {
            redirect(base_url('login'));
        }
    }

    //FAQ
    public function index()
    {
        redirect('account/statement');
    }

    public function statement()
    {
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Account Statement";
        $page_data['sub_name'] = "statement";
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $this->load->view('statement', $page_data);
    }

    public function sales_report()
    {
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Sales Report";
        $page_data['sub_name'] = "sales_report";
        $page_data['order_chart'] = "";
        $page_data['gross_chart'] = "";
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $this->load->view('sales_report', $page_data);
    }
    public function payout()
    {
        $id = $this->session->userdata('logged_id');
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Request Payout";
        $page_data['sub_name'] = "payout";
        $page_data['profile'] = $this->seller->get_profile($id);
        if( $this->input->post() ){
            $this->form_validation->set_rules('payout_amount', 'Amount','trim|required|xss_clean');
            $this->form_validation->set_rules('payout_password', 'Password','trim|required|xss_clean');
            if( $this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error_msg', validation_errors());
                redirect('account/payout/');
            }
            // confirm password
            $amount = $this->input->post('payout_amount', true);
            $password = $this->input->post('payout_password', true);
            if( $this->seller->cur_pass_match($password , $id)){
                // check if the balance does not exeeds
                if( $amount > $page_data['profile']->balance ){
                    $this->session->set_flashdata('error_msg', 'You can not request more than your available balance.');
                    redirect('account/payout/');
                }
                // Generate code
                $code = $this->seller->generate_general_code('payouts', 'token');
                $payout_array = array(
                    'user_id'   => $id,
                    'amount'    => $amount,
                    'token'     => $code,
                    'date_requested'    => get_now(),
                    'status'    => 'pending'
                );

                // send mail
                $email_array = array(
                    'email' => $page_data['profile']->email,
                    'recipent' => 'Dear ' . $page_data['profile']->legal_company_name,
                    'link'  => base_url('authenticate/payment_request/?code=' . $code)
                );
                try {
                    // insert into payment request table
                    $this->seller->insert_data('payouts', $payout_array);
                    $this->seller->set_field('sellers', 'balance', "balance-{$amount}", array('uid' => $id));
                    $this->email->payment_request($email_array);
                    $this->session->set_flashdata('success_msg', "Payment request made. A mail was sent to " . $page_data['profile']->email . ", click on the link to complete your request.");
                } catch (Exception $e) {
                    $error_action = array(
                        'error_action' => 'Seller - Account controller - Payment Request.',
                        'error_message' => $e->getMessage()
                    );
                    $this->email->insert_data('error_logs', $error_action);
                }
            }else{
                $this->session->set_flashdata('error_msg', 'ERROR: Password is incorrect.');
            }
            redirect('account/payout/');
        }else{
            // get the payout history
            $page_data['histories'] = $this->seller->get_results('payouts', 'id,amount,status,date_requested,date_approved,remark', array('user_id' => $id));
            $page_data['incoming_transactions'] = $this->seller->run_sql("SELECT COUNT(*) FROM orders WHERE seller_id = {$id} AND active_status = 'completed' 
AND SUBDATE(NOW(), 'INTERVAL 7 DAY')")->num_rows();
            $page_data['paid'] = $this->seller->run_sql("SELECT SUM(amount) as amt FROM payouts WHERE user_id = {$id} AND status = 'successful' ")->row();
            $page_data['orders'] = $this->seller->run_sql("SELECT order_code FROM orders WHERE seller_id = {$id} AND SUBDATE(NOW(), 'INTERVAL 7 DAY') AND active_status='completed'")->result();
            $this->load->view('payout', $page_data);
        }
    }

    function get_order_detail(){

        if($this->input->is_ajax_request() && $this->input->post()){
            $order_code = $this->input->post('ocode');
            echo json_encode( $this->seller->get_order_details( $order_code) );
            exit;
        }
    }

    public function txn_overview()
    {
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Transaction Overview";
        $page_data['sub_name'] = "statement";
        $page_data['txn_chart'] = "";
        $page_data['profile'] = $this->seller->get_profile($this->session->userdata('logged_id'));
        $this->load->view('txn_overview', $page_data);
    }

}
