<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if( $this->session->userdata('logged_in') ){
            // get the present status of the seller
            $user = $this->seller->get_profile($this->session->userdata('logged_id'));
            if ($user->is_seller == 'approved') {
                $this->session->set_flashdata('success_msg', 'Welcome to your seller dashboard.');
                redirect('overview');
            }elseif( $user->is_seller == 'false' ){
                $this->session->set_flashdata('success_msg', 'Welcome, you need to fill the seller application before proceeding.');;
                redirect('temp');
            }elseif( $user->is_seller == 'pending' ) {
                $this->session->set_flashdata('success_msg', 'Your application was received and its under review. Thank you.');;
                redirect('temp/status');
            }
        } 
    }
    public function index(){
        $page_data['page_title'] = 'Login to your seller account';
        $page_data['pg_name'] = 'login';
        $page_data['meta_tags'] = array( 'css/bootstrap.min.css','css/nifty.min.css','css/nifty-demo-icons.min.css','css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js','js/bootstrap.min.js', 'js/nifty.min.js');
        $this->load->view('login', $page_data);
    }
    /*
     * @Incoming : accepts the login POST parameters : email and password
     * */
    public function process() {
        if(!$_POST){
            redirect('login');
        }else {
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (!isset($response['success']) || $response['success'] !== true) {
                $this->session->set_flashdata('error_msg', 'There was an error validating the captcha, please try again.');
                redirect('login');
            }
            $this->form_validation->set_rules('email', 'Email Address','trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('password', 'Password','trim|required|xss_clean|min_length[6]|max_length[15]');
            $output_array['status'] = 'error';
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error_msg', validation_errors() );
                redirect('login');
            }else{
                $data = array(
                    'email' => trim($this->input->post('email')),
                    'password' => trim($this->input->post('password'))
                );
                $user = $this->seller->login($data);
                if( $user ) {
                    echo 'we are here';
                    $session_data = array('logged_in' => true, 'logged_id' => $user->id, 'seller_status' => $user->is_seller, 'email' => $data['email']);
                    $this->session->set_userdata($session_data);
                    if( $user->is_seller == 'false' ){
                        $this->session->set_flashdata('error_msg',"You don't have a seller account. Please fill the form below to proceed.");
                        redirect('temp');
                    }elseif( $user->is_seller == 'pending' ){
                        $this->session->set_flashdata('error_msg','Your seller application is still under review. You will receive a mail once approved.');
                        redirect('temp/status');
                    }else{
                        $this->session->set_flashdata('success_msg','You are now logged in!');
                        redirect('temp');
                    }
                }else{
                    $link = "<a href='" .base_url('register'). "'>Please create an account to proceed </a>";
                    $this->session->set_flashdata('error_msg',"Sorry we couldn't find your details in our system. {$link}." );
                    redirect(base_url());
                }
            }
        }
    }
}
