<?php
use Mailgun\Mailgun;
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('seller_model', 'seller');
    }
    
    public function index(){
        $msg = Mailgun::create('key-43b8790557f9cf676ccfe03a2bdb5405');
        $result = $msg->messages()->send('sandbox94c46233ed0f4a0a9e4a14a131bab550.mailgun.org',array(
            'from' => 'philip.sokoya@schoolville.com',
            'to'    => 'philipsokoya@gmail.com',
            'subject' => 'Testing the Mailgun SDK',
            'text' => 'Lets test email attachment.',
            array('attachment' => realpath('./assets/landing/img/onitshamarket-logo.png'))
        ));
        var_dump( $result );

    }

}
