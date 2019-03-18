<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect("/");
    }
    public function brand() {

        $page_data['page_title'] = 'Request New Brand';
        $page_data['pg_name'] = 'request';
        $page_data['sub_name'] = 'brand';
        $page_data['profile'] = $this->seller->get_profile_details($this->session->userdata('logged_id'),
            'first_name,last_name,email,profile_pic');
        $page_data['categories'] = $this->seller->get_results('categories');
        if( $this->input->post() ){
            $this->form_validation->set_rules('brand_name', 'Brand name','trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'Brand description','trim|required|xss_clean|min_length[6]');
            if( $this->form_validation->run() == FALSE ){
                $this->session->set_flashdata('error_msg', 'Please fix the following errors'. validation_errors());
                redirect('request/brand');
            }
            $data = array(
                'brand_name' => trim($this->input->post('brand_name')),
                'description' => $this->input->post('description')
            );
            $category_slugs = array();
            foreach( $_POST['categories'] as $category ){
                array_push( $category_slugs, $category );
            }
            $category_slugs = json_encode($category_slugs);
            $data['category_slug'] = $category_slugs;

            if (isset($_FILES) && $_FILES['brand_image']['name'] != '' ) {
                $upload_array = array(
                    'folder' => STATIC_CATEGORY_FOLDER,
                    'filepath' => $_FILES['brand_image']['tmp_name'],
                    'eager' => array("width" => 70, "height" => 70, "crop" => "fill")
                );
                $this->cloudinarylib->upload_image( $upload_array );
                $return = $this->cloudinarylib->get_result('filename');
                if($return){
                    $data['brand_logo'] = $return;
                    unset($upload_array);
                }else{
                    $this->session->set_flashdata('error_msg','There was an error with that image');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }

            if( $this->seller->insert_data('brands', $data) ){
                $this->session->set_flashdata('success_msg', 'The brand has been submitted and under review. Thank you.');
            }else{
                $this->session->set_flashdata('error_msg', 'There was an error submitting your brand.');
            }
            redirect('request/brand');
        }
        $this->load->view('add_brand', $page_data);
    }
}
