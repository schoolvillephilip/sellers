<?php
use Mailgun\Mailgun;
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('seller_model', 'seller');
    }
    
    public function index(){
        $msg = Mailgun::create('key-43b8790557f9cf676ccfe03a2bdb5405');

        $msg->messages()->send('sandbox94c46233ed0f4a0a9e4a14a131bab550.mailgun.org',array(
            'from' => 'philo4u2c@gmail.com',
            'to'    => 'philipsokoya@gmail.com',
            'subject' => 'Testing the Mailgun SDK',
            'text' => 'It is also easy to send'
        ));
        $browser = new Buzz\Browser();
        $response = $browser->get('http://www.google.com');

        echo $browser->getLastRequest()."\n";
        echo $response;
    }

}
