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
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error_msg', '<strong>Please fix the error</strong> <br />' . validation_errors());
            redirect('reset');
        } else {
            // Check if email address is in the system
            $email = $this->input->post('email');
            $user = $this->seller->get_row('users', 'id', "( 'email' = '$email' && 'is_seller' != 'false' ) ");
            if( $user ){
                $data['code'] = $code = $this->seller->generate_general_code( 'users', 'code');
                if( $this->seller->update_data("id = {$user->id}", $data, 'users')) {
                    // send mail
                    // Not a seller
                    $email = $this->input->post('email');
                    $this->session->set_flashdata('success_msg', "Reset mail has been sent to " . $email . " please click on the link in your email.");
                    redirect('login');
                }else{
                    // Not a seller
                    $this->session->set_flashdata('error_msg', "There was an error updating your account, please try again, and if persist, contact support.");
                    redirect('reset');
                }
            }else{
                // Not a seller
                $this->session->set_flashdata('error_msg', "Not a registered seller member, Become a seller now.");
                redirect('register');
            }
        }
    }


    public function change_password(){
        $page_data['page_title'] = 'Change your password';
        $page_data['pg_name'] = 'change_password';
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');
        $this->load->view('reset_change_password', $page_data);
    }
}
