<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller{
    public function __construct(){
        // @todo
        // Check if the user is already logged in
        // Also check where the user is coming from
        parent::__construct();
        $this->load->model('seller_model', 'seller');
//        $this->session->set_userdata('referred_from', current_url());
        if( !$this->session->userdata('logged_in') ){
            // Ursher the person to where he is coming from
            $from = $this->session->userdata('referred_from');
            if( !empty( $from ) ) redirect($this->session->userdata('referred_from'));
            redirect('login');
        }
        // $this->output->enable_profiler(TRUE);

        $user = $this->seller->get_profile( base64_decode($this->session->userdata('logged_id')) );
        if( $user->is_seller == 'false' ){
            $this->session->set_flashdata('success_msg','Please complete the below form to become a seller!');
            redirect('application');
        }elseif( $user->is_seller == 'pending'){
            $this->session->set_flashdata('success_msg','Your account is under review.');
            redirect('application/status');
        } 
    }
    
    public function index(){
        $page_data['profile'] = $this->seller->get_profile(base64_decode($this->session->userdata('logged_id')));
        $page_data['page_title'] = 'Profile Setting';
        $page_data['pg_name'] = 'settings';
        $page_data['sub_name'] = 'profile';
        $page_data['categories'] = $this->seller->get_main_categories();
        $this->load->view('settings', $page_data);

    }

    public function process(){
        if( $this->input->post() ){
            $uid = base64_decode($this->session->userdata('logged_id')) ;
            $page_data['profile'] = $this->seller->get_profile(base64_decode($this->session->userdata('logged_id')));
            switch ($this->input->post('process_type')) {
                case 'profile':
                    $this->form_validation->set_rules('name', 'First name and last name','trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_name', 'Bank name','trim|required|xss_clean');
                    $this->form_validation->set_rules('bvn', 'Bank Verification Number','trim|required|xss_clean');
                    $this->form_validation->set_rules('account_name', 'Account name','trim|required|xss_clean');
                    $this->form_validation->set_rules('account_number', 'Account number','trim|required|xss_clean');
                    if ( $this->form_validation->run() === false ){
                        $this->session->set_flashdata('error_msg','<strong>There was an error updating your information...</strong> <br />' . validation_errors() );
                        redirect('settings');
                    }else{

                        $data = $user_data = array();
                        $uid = base64_decode($this->session->userdata('logged_id')) ;
                        $name = explode(' ', $this->input->post('name'));
                        $user_data['first_name'] = $name[0]; $user_data['last_name'] = $name[1];
                        $data['legal_company_name'] = $this->input->post('legal_company_name');
                        $data['address'] = $this->input->post('address');
                        $data['tin'] = $this->input->post('tin');
                        $data['reg_no'] = $this->input->post('reg_no');
                        $data['license_to_sell'] = $this->input->post('license_to_sell');
                        $data['own_brand'] = $this->input->post('own_brand');
                        $data['no_of_products'] = $this->input->post('no_of_products');
                        $data['main_category'] = $this->input->post('main_category');
                        $data['bank_name'] = $this->input->post('bank_name');
                        $data['bvn'] = $this->input->post('bvn');
                        $data['account_name'] = $this->input->post('account_name');
                        $data['account_number'] = $this->input->post('account_number');
                        if( isset($_FILES['vat_file']) && !is_null($_FILES) ){
                            // is the file the same as present
                            if( !is_dir( base_url('data/sellers/'. $uid .'/' )) || !file_exists(base_url('data/sellers/'. $uid .'/' ))) mkdir('./data/sellers/'.$uid);
                            $file1 = './data/sellers/'.$uid . '/' . $page_data['profile']->vat_file ;
                            $filename = $this->do_upload('vat_file', $page_data['profile']->id);

                            if( $filename && (md5_file($filename) === md5_file($file1)) ){
                                // unset the image
                                unlink('./data/sellers/'. $uid . '/' . $page_data['profile']->vat_file );
                            }
                            $data['vat_file'] = $filename;
                        }
                        // update user table

                        $this->seller->update_data(array('id' => $uid ), $user_data, 'users');

                        if( $this->seller->update_data(array('uid' => $uid), $data, 'sellers') ){
                            $this->session->set_flashdata('success_msg','Success: Your information has been saved successfully.');
                        }else{
                            $this->session->set_flashdata('error_msg','There was an error updating your information.');
                        }
                    }
                    redirect($_SERVER['HTTP_REFERER']);
                    break;
                case 'terms':
                    // terms and condition
                    $this->form_validation->set_rules('terms', 'Terms and condition','trim|required|xss_clean');
                    if( $this->form_validation->run() == false ){
                        $this->session->set_flashdata('error_msg','Error: Please fix the error <br />'. validation_errors());

                    }else{
                        if( $this->seller->update_data(array('uid' => $uid) , array('terms' => cleanit($this->input->post('terms'))), 'sellers') ){
                            $this->session->set_flashdata('success_msg','Success: Your information has been saved successfully.');
                        }else{
                            $this->session->set_flashdata('error_msg','There was an error updating your information.');
                        }
                    }
                    redirect('settings');
                    break;
                case 'logo':

                    break;
                default:
                    # code...
                    break;
            }
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function change_password(){
        $id = base64_decode($this->session->userdata('logged_id'));
        $page_data['profile'] = $this->seller->get_profile( $id );
        if( !$this->input->post() ){
            $page_data['page_title'] = "Seller's Profile Setting - " . lang('app_name');
            $page_data['pg_name'] = 'settings';
            $page_data['sub_name'] = 'change_password';
            $this->load->view('change_password', $page_data);
        }else{
            $this->form_validation->set_rules('current_password', 'Current password','trim|required|xss_clean');
            $this->form_validation->set_rules('new_password', 'New Password','trim|required|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password','trim|required|xss_clean|matches[new_password]');
            if( $this->form_validation->run() == false ){
                $this->session->set_flashdata('error_msg', 'Error: please fix the following error.' .validation_errors());
            }else{
                if( !$this->seller->cur_pass_match($this->input->post('current_password'), $id)){
                    $this->session->set_flashdata('error_msg', 'Error: the current password does not match');
                }else{
                    $this->seller->change_password($this->input->post('new_password'),  $id);
                    $this->session->set_flashdata('success_msg', 'Success: Password changed.');
                }
            }
            redirect($_SERVER['HTTP_REFERER']);
        }

    }

    // Upload function
    public function do_upload($file, $id){
        $config['upload_path']          = './data/sellers/' . $id . '/';
        $config['allowed_types']        = 'gif|jpg|png|JPEG|jpeg|bmp|pdf|doc|docx';
        $config['max_size']             = 10048;
        $config['overwrite']			= true;
        $config['encrypt_name'] 		= TRUE;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload( $file )){
//            print_r( $this->upload->display_errors());
//            exit;
            return 'There was an error';
        }else{
            return $this->upload->data('file_name');
        }
    }
}
