<?php
//use Mailgun\Mailgun;
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('seller_model', 'seller');
    }
    
    public function index(){
//        $msg = Mailgun::create('key-43b8790557f9cf676ccfe03a2bdb5405');
//        $result = $msg->messages()->send('sandbox94c46233ed0f4a0a9e4a14a131bab550.mailgun.org',array(
//            'from' => 'philip.sokoya@schoolville.com',
//            'to'    => 'philipsokoya@gmail.com',
//            'subject' => 'Testing the Mailgun SDK',
//            'text' => 'Lets test email attachment.',
//            array('attachment' => realpath('./assets/landing/img/onitshamarket-logo.png'))
//        ));
//        var_dump( $result );

        $configuration = new \ElasticEmailClient\ApiConfiguration(array(
            'apiUrl' => 'https://api.elasticemail.com/v2/',
            'apiKey' => 'f818fbbb-bb76-4de0-ad47-e458303b0d12'
        ));
        $client = new \ElasticEmailClient\ElasticClient($configuration);

    }

    function summernote(){
        $this->load->view('summernote');
    }

    function check(){
        $string = '<div class="prod_description"><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and 
typesetting industry. Lorem Ipsum has been the industry\'s standard dummy
 text ever since the 1500s, when an unknown printer took a galley of 
type and scrambled it to make a type specimen book. It has survived not 
only five centuries, but also the leap into electronic typesetting, 
remaining essentially unchanged.</p><p><img src="https://res.cloudinary.com/onitshamarket/image/upload/v1549048621/onitshamarket/product/description/aybzzmvqwdggkd71qc3a.jpg" style="width: 25%;"><br></p><p> It was popularised in the 1960s with 
the release of Letraset sheets containing Lorem Ipsum passages, and more
 recently with desktop publishing software like Aldus PageMaker 
including versions of Lorem Ipsum.</p></div>';
        $nlbreak = nl2br($string);
        echo $nlbreak;
        exit;
    }

}
