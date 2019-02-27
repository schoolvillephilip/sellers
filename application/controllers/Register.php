<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        // @todo
        parent::__construct();
        $this->load->model('seller_model', 'seller');
        if ($this->session->userdata('logged_in')) {
            $from = $this->session->userdata('referred_from');
            if (!empty($from)) redirect($from);
            redirect(base_url());
        }
    }

    public function index()
    {
        $page_data['page_title'] = 'Register to be part of the community';
        $page_data['pg_name'] = 'regintro';
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');
        $this->load->view('introduction', $page_data);
    }

    public function form()
    {
        $page_data['page_title'] = 'Seller Registration';
        $page_data['pg_name'] = 'register';
        $page_data['categories'] = $this->seller->get_results('categories', 'id,name', " ( pid = 0) ");
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');
        $this->load->view('register', $page_data);
    }

    /*
     * @Incoming : accepts the sign up POST parameters
     * result : string (success | error )
     * */
    function process()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|valid_email');
        // $this->form_validation->set_message('is_unique', 'The %s is already taken');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[8]|max_length[15]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|min_length[8]|max_length[15]|matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error_msg', '<strong>There was an error when creating the account. Please fix the following</strong> <br />' . validation_errors());
            redirect('register/form/');
        } else {
            // Check if email address is in the system
            $email = $this->input->post('email', true);
            $email = trim($email);
            $user = $this->seller->get_row('users', '*', "( email = '$email' ) ");
            $license_to_sell = ($this->input->post('license_to_sell') == true) ? 1 : 0;
            $plat = $this->input->post('platform');
            $platform = ( !empty( $plat )) ? $plat : '';
            $seller_data = array(
                'legal_company_name' => $this->input->post('legal_company_name', true),
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

            $user_data = array(
                'is_seller' => 'pending',
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name')
            );

            if ($user) {
                // we are updating
                $seller_data['uid'] = $user->id;
                // Do we already have this user in seller table
                if( $this->seller->get_row('sellers','id', "( uid = $user->id ) ") ){
                    $this->session->set_flashdata('error_msg', 'You already have a seller account. login with your details to access your dashboard.');
                    redirect('login');
                }
                if ($this->seller->create_account($seller_data, 'sellers')) {
                    $this->seller->update_data($user->id, $user_data, 'users');
                    $this->session->set_flashdata('success_msg', 'Congrats your application has been received and under review, you will be mailed on the update.');
                    // Email Model
                    $email_array = array(
                        'email' => $email,
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
                    redirect('login');
                } else {
                    $this->session->set_flashdata('error_msg', 'There was an error creating your seller account, please you can contact support if it persist.');
                    redirect('register/form');
                }
            } else {
                // we are creating
                $user_data['email'] = $this->input->post('email');
                $salt = salt(50);
                $user_data['password'] = shaPassword($this->input->post('password'), $salt);
                $user_data['salt'] = $salt;
                $user_data['date_registered'] = get_now();
                $user_data['last_login'] = get_now();
                $user_data['is_seller'] = 'pending';
                $user_id = $this->seller->create_account($user_data, 'users');
                if (!is_numeric($user_id)) {
                    $this->session->set_flashdata('error_msg', 'There was an error creating your account, please you can contact support if it persist.');
                    redirect('register/form');
                } else {
                    $seller_data['uid'] = $user_id;
                    if ($this->seller->create_account($seller_data, 'sellers')) {
                        // Email Model
                        try {
                            $bodyHytml = '<p>Please note that you can as well use this same details to buy items on onitshamarket.com</p>';
                            $email_array = array(
                                'email' => $email,
                                'recipent' => 'Dear '. $user_data['first_name'] . ' ' . $user_data['last_name'],
                                'bodyHtml' => $bodyHytml
                            );
                            $this->email->welcome_user( $email_array);
                            $this->session->set_flashdata('success_msg', 'Thanks your application has been received and under review, you will be mailed on the update.');
                            redirect('login');
                        } catch (Exception $e) {
                            // log the error
                            $error_action = array(
                                'error_action' => 'Seller Register Controller',
                                'error_message' => $e->getMessage()
                            );
                            $this->seller->insert_data('error_logs', $error_action);
                        }
                    } else {
                        $this->session->set_flashdata('error_msg', 'There was an error creating your seller account, please you can contact support if it persist.');
                        redirect('register/form');
                    }
                }
            }
        }
    }
}
