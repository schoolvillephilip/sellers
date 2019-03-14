<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $user = $this->seller->get_profile($this->session->userdata('logged_id'));
        if ($user->is_seller == 'approved') {
            $this->session->set_flashdata('success_msg', 'Welcome to your seller dashboard.');
            redirect('overview');
        }
    }

    public function index() {
        if ($this->session->userdata('seller_status')  == 'pending' ){
            $this->session->userdata('error_msg', 'Your account is under review, you will be notified via email on approval');
            redirect('temp/status');
        }

        $page_data['page_title'] = 'Seller Registration';
        $page_data['pg_name'] = 'register';
        $page_data['categories'] = $this->seller->get_results('categories', 'id,name', " ( pid = 0) ");
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');
        // seller application form
        $this->load->view('reg_form', $page_data);
    }

    /*
     * @Incoming : accepts the sign up POST parameters
     * result : string (success | error )
     * */
    function process()
    {
//        echo ' We are here ';
//
//        echo '<br />';
//
//        var_dump( $_POST );
//
//        echo ' data was meant to be dumped ';
//        exit;
//        $data = file_get_contents("php://input");
//        $data = json_decode($data,true);

        $this->form_validation->set_rules('legal_company_name', 'Business Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('store_name', 'Store Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('store_address', 'Store Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('main_category', 'Man Category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('account_name', 'Account Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('account_number', 'Account Number', 'trim|required|xss_clean');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect( 'temp');
        }else{
            $license_to_sell = ($this->input->post('license_to_sell') == true) ? 1 : 0;
            $plat = $this->input->post('platform');
            $platform = ( !empty( $plat )) ? $plat : '';
            $seller_data = array(
                'legal_company_name' => $this->input->post('legal_company_name', true),
                'store_name' => $this->input->post('store_name', true),
                'address' => $this->input->post('store_address', true),
                'tin' => $this->input->post('tin', true),
                'main_category' => $this->input->post('main_category', true),
                'license_to_sell' => $license_to_sell,
                'reg_no' => $this->input->post('reg_no', true),
                'no_of_products' => $this->input->post('no_of_products', true),
                'product_condition' => $this->input->post('product_condition', true),
                'platform_selling' => $platform,
                'account_number' => $this->input->post('account_number', true),
                'account_name' => $this->input->post('account_name', true),
                'bank_name' => $this->input->post('bank_name', true),
                'account_type' => $this->input->post('account_type', true),
                'date_applied' => get_now(),
                'seller_phone' => $this->input->post('phone_number', true)
            );



            $seller_data['uid'] = $uid = $this->session->userdata('logged_id');

            // Do we already have this user in seller table
            if( $this->seller->get_row('sellers','id', "( uid = $uid ) ") ){
                $this->session->set_flashdata('error_msg', 'You already have a seller account. login with your details to access your dashboard.');
                redirect('login');
            }
            if ($this->seller->create_account($seller_data, 'sellers')) {
                $user_data = array( 'is_seller' => 'pending' );
                $this->seller->update_data(array('id' => $uid), $user_data, 'users');
                $this->session->set_flashdata('success_msg', 'Congrats your application has been received and under review, you will be mailed on the update.');
                // Email Model
                $email_array = array(
                    'email' => $this->session->userdata('email'),
                    'recipent' => 'Dear '. $user_data['first_name'] . ' ' . $user_data['last_name']
                );
                $status = $this->email->welcome_user($email_array);
                if( !$status ){
                    // log the error
                    $error_action = array(
                        'error_action' => 'Seller Register Controller',
                        'error_message' => $status['error']
                    );
                    $this->seller->insert_data('error_logs', $error_action);
                }
                redirect('temp/status');
            } else {
                $this->session->set_flashdata('error_msg', 'There was an error creating your seller account, please you can contact support if it persist.');
                redirect('temp');
            }

        }

    }


    function status()
    {
        $user = $this->seller->get_profile($this->session->userdata('logged_id'));
        if ($user && $user->is_seller == 'false') {
            $this->session->set_flashdata('success_msg', 'Please fill in the form to become a seller.');
            redirect('temp');
        }
        $page_data['status'] = $this->seller->get_seller_status($this->session->userdata('logged_id'));
        $page_data['page_title'] = 'Seller Application Status';
        $page_data['pg_name'] = 'application';
        $page_data['sub_name'] = 'application_status';
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');
        $this->load->view('application_status', $page_data);

    }
}
