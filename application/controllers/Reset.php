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
            $user = $this->seller->get_row('users', 'id', "email = '$email' AND is_seller != 'false' ");
            if( $user ){
                $data['code'] = $code = $this->seller->generate_general_code( 'users', 'code');
                if( $this->seller->update_data("id = {$user->id}", $data, 'users')) {
                    // send mail
                    // Not a seller
                    $email = $this->input->post('email');
                    $this->session->set_flashdata('success_msg', "Reset mail has been sent to " . $email . " please click on the link in your email to reset your password.");
                    redirect('login');
                } else {
                    // Not a seller
                    $this->session->set_flashdata('error_msg', "There was an error updating your account, please try again, and if persist, contact support.");
                    redirect('reset');
                }
            } else {
                // Not a seller
                $this->session->set_flashdata('error_msg', "Not a registered seller member, Become a seller now.");
                redirect('register');
            }
        }
    }

    public function activate(){
        $token = cleanit($this->input->get('token'));
        if( $token && !empty( $token )){
            $user = $this->get_row('users', 'id', "code = {$token}");
            if( $user ){
                $this->session->set_userdata('id', $user->id);
                $this->session->userdata('success_msg', 'Token confirmed! Please set a new password');
                redirect('reset/reset_password');
            }else{
                $this->session->userdata('error_msg', 'Incorrect recovery token, please contact support team for more assistance.');
            }
        }
        redirect('recover');
    }

    public function reset_password(){
        $page_data['page_title'] = 'Change your password';
        $page_data['pg_name'] = 'change_password';
        $page_data['meta_tags'] = array('css/bootstrap.min.css', 'css/nifty.min.css', 'css/nifty-demo-icons.min.css', 'css/nifty-demo.min.css');
        $page_data['scripts'] = array('js/jquery.min.js', 'js/bootstrap.min.js', 'js/nifty.min.js');

        if( !$this->session->userdata('id')) redirect('reset');
        if( $this->input->post() ){
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error_msg', '<strong>Please fix the error</strong> <br />' . validation_errors());
            }else{
                $id = $this->session->userdata('id');
                $password = cleanit($this->input->post('password'));
                if($this->seller->change_password($password, $id, 'users')){
                    // delete the token
                    $this->db->seller->update_data("( id = $id)", array('code' => '', 'users' ));
                    $this->session->userdata('success_msg', 'Password changed successfully, please enter your email, and new password.');
                    redirect('login');
                }
                $this->session->userdata('error_msg', 'Error updating your new password, please contact support.');
            }
            redirect('reset/reset_password');
        }else{
            $this->load->view('reset_change_password', $page_data);
        }
    }
}
