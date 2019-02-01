<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // Get the general settings
        if (!$this->session->userdata('logged_in')) {
            $from = $this->session->userdata('referred_from');
            if (!empty($from)) redirect($from);
            $this->session->set_flashdata('error_msg',"You need to login to have access.");
            redirect('login');
        }
        // $this->output->enable_profiler(TRUE);
        $user = $this->seller->get_profile( $this->session->userdata('logged_id') );
        if( $user->is_seller == 'false' ){
            $this->session->set_flashdata('error_msg',"You don't have seller account.");
            redirect('login');
        }elseif( $user->is_seller == 'pending'){
            $this->session->set_flashdata('error_msg','Your account is under review. You will be notified of the status via email.');
            redirect('login');
        }
        $controller = $this->uri->segment(1);
        if( $this->session->has_userdata('category_id') && $controller != 'product' ){
            $this->session->unset_userdata('category_id');
        }
    }
}