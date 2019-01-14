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


    public function index()
    {
        redirect('account/statement');
    }

    public function statement()
    {
        $uid = $this->session->userdata('logged_id');
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Account Statement";
        $page_data['sub_name'] = "statement";
        $page_data['profile'] = $this->seller->get_profile($uid);
        $page_data['due_unpaid'] = $this->seller->due_unpaid( $uid);
        $page_data['commission'] = $this->seller->run_sql("SELECT SUM(commission) amount FROM orders WHERE seller_id = {$uid} AND active_status = 'completed'")->row();
        $page_data['last_3_month'] = $this->seller->last_3_month($uid);
        $page_data['last_3_month_paid'] = $this->seller->last_3_month_paid($uid);
        $page_data['completed_sales'] = $this->seller->run_sql("SELECT SUM(amount) amount FROM orders WHERE seller_id = {$uid} AND active_status ='completed'")->row();
        $this->load->view('statement', $page_data);
    }

    public function sales_report()
    {
        $uid = $this->session->userdata('logged_id');
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Sales Report";
        $page_data['sub_name'] = "sales_report";
        $page_data['order_chart'] = "";
        $page_data['gross_chart'] = "";
        $page_data['profile'] = $this->seller->get_profile($uid);
        $page_data['order_chart'] = $this->seller->order_chart($uid);
        $page_data['commission'] = $this->seller->run_sql("SELECT SUM(commission) amount FROM orders WHERE seller_id = {$uid} AND active_status = 'completed'")->row();
        $page_data['total_sales'] = $this->seller->run_sql("SELECT SUM(amount) amount FROM orders WHERE seller_id = {$uid} AND active_status = 'completed'")->row();
        $page_data['sales'] = $page_data['total_sales']->amount - $page_data['commission']->amount;
        $page_data['completed_sales'] = $this->seller->run_sql("SELECT SUM(amount) amount FROM orders WHERE seller_id = {$uid} AND active_status ='completed'")->row();
        $page_data['top_orders'] = $this->seller->top_20_sales( $uid );
        $this->load->view('sales_report', $page_data);
    }
//    Account Payout Overview and request
    public function payout(){
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
                $txn_code = time() + $id ;
                $payout_array = array(
                    'user_id'   => $id,
                    'amount'    => $amount,
                    'token'     => $code,
                    'transaction_code' => $txn_code,
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
            $page_data['histories'] = $this->seller->run_sql("SELECT id, amount, status,transaction_code, date_requested,date_approved,status, remark FROM payouts WHERE user_id = {$id} ORDER BY date_requested DESC")->result();
            $page_data['incoming_balance'] = $this->seller->incoming_balance( $id );
            $page_data['incoming_order_code'] = $this->seller->incoming_order_code( $id );
            $page_data['total_commission'] = $this->seller->last_7_days_commision( $id );
            $page_data['paid'] = $this->seller->run_sql("SELECT SUM(amount) as amt FROM payouts WHERE user_id = {$id} AND status = 'completed' ")->row();
            $this->load->view('payout', $page_data);
        }
    }

    function rescend_mail(){
        if( $this->input->post('code')){
            $code = $this->input->post('code', true);
            $email = $this->session->userdata('email');
            $email_array = array(
                'email' => $email,
                'recipent' => 'Hello' ,
                'link'  => base_url('authenticate/payment_request/?code=' . $code)
            );
            try {
                $this->email->payment_request($email_array);
                $this->session->set_flashdata('success_msg', 'A new mail has been sent to your email (' . $email . ' ), kindly check your span if not seen in inbox section.');
            } catch (Exception $e) {
                $this->session->set_flashdata('error_msg', 'There was an error performing that action');
            }
        }
        redirect( $_SERVER['HTTP_REFERER']);
    }

    //    Get order detail ajax used in payout request
    function get_order_detail(){
        if($this->input->is_ajax_request() && $this->input->post()){
            $order_code = $this->input->post('ocode');
            echo json_encode( $this->seller->incoming_order_code_detail( $order_code) );
            exit;
        }
    }


    public function txn_overview()
    {
        $uid = $this->session->userdata('logged_id');
        $page_data['pg_name'] = 'report';
        $page_data['page_title'] = "Transaction Overview";
        $page_data['sub_name'] = "statement";
        $page_data['profile'] = $this->seller->get_profile($uid);
        $page_data['transactions'] = $this->seller->run_sql("SELECT SUM(amount) as amount, DATE_FORMAT(date_requested,'%Y-%m') omonth 
          FROM payouts WHERE user_id = {$uid} AND status = 'completed'
          AND `date_requested` BETWEEN DATE_SUB(CURDATE(),INTERVAL 3 MONTH ) AND DATE_SUB(CURDATE() ,INTERVAL 0 MONTH)
          GROUP BY omonth ORDER BY omonth")->result();
        $this->load->view('txn_overview', $page_data);
    }

}
