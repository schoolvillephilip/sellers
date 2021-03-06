<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email_model extends CI_Model {


    function reset_password( $data ){
        $post = array(
            'subject' => 'Reset Password Confirmation',
            'to' => $data['email'],
            'template' => 'UserPasswordReset',
            'merge_reset_link' => $data['reset_link'],
            'isTransactional' => false
        );
        return $this->send_now($post);
    }

    function welcome_user( $data ){
        $post = array(
            'subject' => 'Welcome to Onitshamarket Seller Center',
            'to' => $data['email'],
            'template' => 'WelcomeSellerUser',
            'merge_recipent' => $data['recipent'],
            'merge_subject' => 'Welcome to Onitshamarket Seller Center',
            'isTransactional' => false
        );
        return $this->send_now($post);
    }

    // Welcome user for new account creates
    function welcome_buyer( $data ){
        $post = array(
            'subject' => 'Welcome to Onitshamarket' ,
            'to' => $data['email'],
            'from' => 'info@onitshamarket.com',
            'template' => 'WelcomeNewUser',
            'merge_recipent' => $data['recipent'],
            'isTransactional' => false
        );
        return $this->send_now($post);
    }


    // Payment request
    function payment_request( $data ){
        $post = array(
            'subject' => 'Payment Request Initiated',
            'to' => $data['email'],
            'from' => 'seller.payment@onitshamarket.com',
            'template' => 'PaymentRequest',
            'merge_recipent' => $data['recipent'],
            'merge_link' => $data['link'],
            'isTransactional' => false
        );
        return $this->send_now($post);
    }

    // Curl function to send
    function send_now($post){
        $url = 'https://api.elasticemail.com/v2/email/send';
        try{
            $post['merge_base_url'] = base_url();
            $post['from'] = isset($post['from']) ? $post['from'] : 'noreply@onitshamarket.com';
            $post['fromName'] = 'Onitshamarket.com';
            $post['apikey'] = ELASTIC_EMAIL_API;
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $post,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYPEER => false
            ));
            $result = curl_exec($ch);
            curl_close ($ch);
            return $result;
        }catch(Exception $ex){
            $this->session->set_flashdata('error_msg',$ex->getMessage());
            return false;
        }
    }
}