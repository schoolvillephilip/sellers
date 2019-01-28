<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        redirect(base_url());
    }

    /*
     *
     * Authenticate Payment Request Token for seller...*/
    public function payment_request(){

        $code = cleanit($this->input->get('code', true));
        $user = $this->seller->get_row('payouts','id,user_id', array('token' => $code ));
        if( $code && $user ){
            // change the status
            if( $this->seller->update_data(array('id' => $user->id),
                array('status' => 'processing', 'token' => ''),
                'payouts'
            )){
                $this->session->set_flashdata('success_msg', 'Payment request has been validated, you will be credited.');
            }else{
                $this->session->set_flashdata('error_msg', 'There was an error validating your payment request, you can try again, and if persist, contact support');
            }
            if( $this->session->userdata('logged_in')) redirect('account/payout');
            redirect(base_url());
        }else{
            $this->session->set_flashdata('error_msg', 'The token is invalid or has been initiated already.');
            redirect(base_url());
        }
    }
}
