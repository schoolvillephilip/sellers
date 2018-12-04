<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function index()
    {
        $sessions = $this->session->all_userdata();
        foreach ($sessions as $key => $value) {
            if ($key != 'cart_contents') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session_destroy();
        redirect(base_url('login'));
    }

}
