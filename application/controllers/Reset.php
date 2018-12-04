<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller
{
    public function __construct()
    {
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
        $page_data['page_title'] = 'Reset your password';
        $page_data['pg_name'] = 'reset';
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');
        $this->load->view('reset', $page_data);
    }

    /*
     * @Incoming : accepts the sign up POST parameters
     * result : string (success | error )
     * */
    function process()
    {

        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|valid_email');
        // $this->form_validation->set_message('is_unique', 'The %s is already taken');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[8]|max_length[15]');
        $this->form_validation->set_rules('confirm_password', 'Password', 'trim|required|xss_clean|min_length[8]|max_length[15]|matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error_msg', '<strong>There was an error when creating the account. Please fix the following</strong> <br />' . validation_errors());
            redirect('register');
        } else {
            // Check if email address is in the system
            $email = $this->input->post('email');
            $user = $this->seller->get_row('users', '*', "( email = '$email' ) ");
            $license_to_sell = ($this->input->post('license_to_sell') == true) ? 1 : 0;
            $plat = $this->input->post('platform');
            $platform = ( !empty( $plat )) ? $plat : '';
            $seller_data = array(
                'legal_company_name' => $this->input->post('legal_company_name'),
                'address' => $this->input->post('store_address'),
                'tin' => $this->input->post('tin'),
                'main_category' => $this->input->post('main_category'),
                'license_to_sell' => $license_to_sell,
                'reg_no' => $this->input->post('reg_no'),
                'no_of_products' => $this->input->post('no_of_products'),
                'product_condition' => $this->input->post('product_condition'),
                'platform_selling' => $platform,
                'account_number' => $this->input->post('account_number'),
                'account_name' => $this->input->post('account_name'),
                'bank_name' => $this->input->post('bank_name'),
                'account_type' => $this->input->post('account_type'),
                'date_applied' => get_now()
            );
            $user_data = array(
                'is_seller' => 'pending',
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone_number')
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
                        $this->session->set_flashdata('success_msg', 'Congrats your application has been received and under review, you will be mailed on the update.');
                        redirect('login');
                    } else {
                        $this->session->set_flashdata('error_msg', 'There was an error creating your seller account, please you can contact support if it persist.');
                        redirect('register/form');
                    }
                }
            }
        }
    }
}
