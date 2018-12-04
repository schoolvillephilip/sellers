<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // Get the general settings
        if (!$this->session->userdata('logged_in')) {
            $from = $this->session->userdata('referred_from');
            if (!empty($from)) redirect($this->session->userdata('referred_from'));
            redirect('login');
        }
        // $this->output->enable_profiler(TRUE);
        $user = $this->seller->get_profile( $this->session->userdata('logged_id') );
        if( $user->is_seller == 'false' ){
            $this->session->set_flashdata('error_msg',"You don't have seller account.");
            $this->session->sess_destroy();
            redirect('login');
        }elseif( $user->is_seller == 'pending'){
            $this->session->set_flashdata('success_msg','Your account is under review. You will be notified of the status via email.');
            $this->session->sess_destroy();
            redirect('login');
        }
    }
}