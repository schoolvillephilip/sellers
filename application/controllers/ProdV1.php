<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('seller_model', 'seller');
        if( !$this->session->userdata('logged_in') ){
            // Ursher the person to where he is coming from
            $from = $this->session->userdata('referred_from');
            if( !empty($from) ) redirect($from);
            redirect('seller/login');
        }
         // $this->output->enable_profiler(TRUE);
        $user = $this->seller->get_profile( base64_decode($this->session->userdata('logged_id')) );
        if( $user->is_seller == 'false' ){
            $this->session->set_flashdata('success_msg','Please complete the below form to become a seller!');
            redirect('seller/application');
        }elseif( $user->is_seller == 'pending'){
            $this->session->set_flashdata('success_msg','Your account is under review.');
            redirect('seller/application/status');
        } 
    }

    public function index(){
        if( $this->input->post('category_id') ){
            $category_id =  $this->input->post('category_id');

            $this->session->set_userdata(array('category_id' => $category_id)) ;
            redirect('seller/product/create');
        }else{
            // Unset the category
            $this->session->unset_userdata('category_id');
            $uid = base64_decode($this->session->userdata('logged_id'));
            $page_data['page_title'] = 'Choose Category';
            $page_data['pg_name'] = 'product';
            $page_data['sub_name'] = 'select_category';
            $page_data['profile'] = $this->seller->get_profile_details($uid,
                'first_name,last_name,email,profile_pic');
            $page_data['categories'] = $this->seller->get_main_categories();
            $this->load->view('seller/choose_category', $page_data);
        }
    }

    /**
     *
     */
    public function create(){
        // check if we have the category session set
        if( $this->session->has_userdata('category_id') ){
            $sub_id = $this->session->userdata('category_id');
            $spec_result  = $this->seller->get_parent_details($sub_id);
            $specification_array = $categories_name = array();
            foreach( $spec_result as $result ){               
                $categories_name[] = $result->name;
                if( $result->specifications !== '' ) {
                    $decode = json_decode( $result->specifications );
                    $x = 0;
                    $spec_array = array();
                    foreach( $decode as $key => $value ) {
                        $specification = $this->seller->get_specifications( $value ); 
                        if( $specification ) {
                            $spec_array['category_name'] = $result->name;
                            $spec_array['description'] = $result->description;
                            $spec_array['specifications'][$x]['spec_id']  = $value;
                            $spec_array['specifications'][$x]['spec_name'] = $specification->spec_name;
                            $spec_array['specifications'][$x]['spec_options'] = $specification->options;
                            $spec_array['specifications'][$x]['multiple_options'] = $specification->multiple_options;
                            $spec_array['specifications'][$x]['spec_description'] = $specification->description;
                            $x++;
                        }
                    }
                    array_push( $specification_array, $spec_array);
                }
            }
            $page_data['categories_name'] = $categories_name;
            $page_data['features'] = $specification_array;
            // Check if post method
            $uid = base64_decode($this->session->userdata('logged_id'));
            $page_data['page_title'] = 'Add product';
            $page_data['pg_name'] = 'product';
            $page_data['sub_name'] = 'add_product';
            $page_data['profile'] = $this->seller->get_profile_details( $uid ,
                'first_name,last_name,email,profile_pic');
            $page_data['brands'] = $this->seller->get_results('brands');
            $category_details = $this->seller->get_row('categories', 'variation_name, variation_options', "( id = {$sub_id})");
            $option_array = array();
            if( !empty($category_details->variation_options) ){
                $options = json_decode( $category_details->variation_options);
                foreach( $options as $option ){
                    $option_name = $this->seller->get_row('options', 'name', " (id = {$option})")->name;
                    array_push( $option_array, $option_name);
                }
            }
            $page_data['variation_name'] = $category_details->variation_name;
            $page_data['variation_options'] = $option_array;
            $this->load->view('seller/create', $page_data);
        }else{
            // redirect to make a selection of category
            $this->session->set_flashdata('error_msg', 'Info. : You need to Select a Category first for the product.');
            redirect('seller/product');
        }
    }

    public function process(){
        if( $this->input->post() || isset($_FILES) ){
            $pricing_error = $image_error = 0;
            $return['status'] = 'error';
            $return['message'] = '';
                // Product Block
            $certifications = $this->input->post('certifications');
            $certifications = (!empty($certifications) ) ? json_encode($certifications) : '';
            $warranty_type = $this->input->post('warranty_type');
            $warranty_type = ( !empty($warranty_type) ) ? json_encode( $warranty_type ) : '';
            $colour_family = $this->input->post('colour_family');
            $colour_family = ( !empty( $colour_family) ) ? json_encode( $colour_family ) : '';
            $sku = $this->product->generate_code();
            $product_table = array(
                'seller_id' => base64_decode($this->session->userdata('logged_id')),
                'sku' => $sku,
                'category_id' => $this->session->userdata('category_id'),
                'product_name' => cleanit($this->input->post('product_name')),
                'brand_name' => cleanit($this->input->post('brand_name')),
                'model' => cleanit($this->input->post('model')),
                'main_colour' => $this->input->post('main_colour'),
                'product_description' => htmlentities($this->input->post('product_description'), ENT_QUOTES),
                'youtube_id' => cleanit($this->input->post('youtube_id')),
                'in_the_box' => htmlentities($this->input->post('in_the_box'), ENT_QUOTES),
                'highlights' => htmlentities($this->input->post('highlights'), ENT_QUOTES),
                'product_line' => cleanit( $this->input->post('product_line')),
                'colour_family' => $colour_family,
                'main_material' => $this->input->post('main_material'),
                'dimensions' => cleanit($this->input->post('dimensions')),
                'weight'    => cleanit($this->input->post('weight')),
                'product_warranty' => htmlentities($this->input->post('product_warranty') , ENT_QUOTES),
                'warranty_type' => $warranty_type,
                'warranty_address' => $this->input->post('warranty_address'),
                'certifications' => $certifications,
                'product_status' => 'pending',
                'created_on' => get_now()
            );


            //     Product Features Block
            // Since we are getting the specification name; we loop through the specification json
            // SELECT id FROM specifications WHERE spec_name = 'POST_KEY'
            $attributes = array();
            foreach($_POST as $post => $value ){
                if( substr_compare('attribute_',$post,0,10 ) == 0 ){
                    // we found a match
                    // check if its a multiple
//                    {"Features":[" Anti Glare"],"Display":"gps"}
                    // @TODO: fix the multiple value
                    $feature_name = explode('_', $post);
                    if( is_array($post) && !empty($value)){
                        $x= json_encode($value);
                        $attributes[$feature_name[1]] = json_encode(json_decode($x));
                    }elseif(!empty($value)){
                        $attributes[$feature_name[1]] = trim($value);
                    }
                }
            }
            
            $product_table['attributes'] = json_encode($attributes);
            $product_id  = $this->seller->insert_data('products', $product_table);
            // Product Variation Block
            $count_check = sizeof($this->input->post('sale_price'));
            // Declare all variables
            $variation = $this->input->post('variation');
            $sku = $this->input->post('sku');
            $isbn = $this->input->post('isbn');
            $quantity = $this->input->post('quantity');
            $sale_price = $this->input->post('sale_price');
            $discount_price = $this->input->post('discount_price');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            if( $count_check > 0 ){
                for( $i = 0; $i < $count_check; $i++ ){
                    $variation_data['product_id'] = $product_id;
                    $variation_data['variation'] = $variation[$i];
                    $variation_data['sku']      = $sku[$i];
                    $variation_data['isbn']     = $isbn[$i];
                    $variation_data['quantity']  = $quantity[$i];
                    $variation_data['sale_price'] = $sale_price[$i];
                    $variation_data['discount_price'] = $discount_price[$i];
                    $variation_data['start_date'] = $start_date[$i];
                    $variation_data['end_date'] = $end_date[$i];
                    // if( $variation_data['variation'] == '' ||
                    //     $variation_data['sku'] == '' ||
                    //     $variation_data['isbn'] == '' ||
                    //     $variation_data['quantity'] == '' ||
                    //     $variation_data['discount_price'] == '' ||
                    //     $variation_data['start_date'] == '' ||
                    //     $variation_data['end_date'] == ''  )
                    //     continue;
                    // create a new variation row
                    if( empty($variation_data['discount_price']) ) { $variation_data['start_date'] = $variation_data['end_date'] ='';}

                    if( $variation_data['quantity'] > 10 ) $variation_data['quantity'] = 10;
                    
                    if( !is_int($this->seller->insert_data('product_variation', $variation_data) ) ){
                        throw new Exception( 'There was an error inserting the variation' . $this->seller->insert_data('product_variation', $variation_data));
                    }
                }
            }

            // Product Gallery Block
            if( isset($_FILES) ){
                $counts = sizeof($_FILES['file']['tmp_name']);
                $product_gallery = array(
                    'product_id'    => $product_id,
                    'seller_id' => base64_decode($this->session->userdata('logged_id')),
                    'created_at' => get_now()
                );
                $files = $_FILES;
                for ( $x = 0; $x < $counts; $x++ ){
                    $old_name = $files['file']['name'][$x];
                    $_FILES['file']['name']= $files['file']['name'][$x];
                    $_FILES['file']['type']= $files['file']['type'][$x];
                    $_FILES['file']['tmp_name']= $files['file']['tmp_name'][$x];
                    $_FILES['file']['error']= $files['file']['error'][$x];
                    $_FILES['file']['size']= $files['file']['size'][$x];

                    if( !is_dir("./data/products/$product_id/") ) mkdir("./data/products/$product_id/");

                    $upload_result = $this->do_upload('file', $product_id);

                    if( $upload_result ){
                        $product_gallery['image_name'] = $upload_result;
                        $product_gallery['featured_image'] = ( isset($_POST['featured_image']) && ($old_name == $_POST['featured_image'] )) ? 1 : 0;
                        if( $counts == 1 ) $product_gallery['featured_image'] = 1;
                        if( !is_int($this->seller->insert_data('product_gallery', $product_gallery)) ){
                            $image_error++;
                        }
                    }else{
                        $image_error++;
                    }                    
                }// end of for loop

            }

            // Check for errors
            if( $pricing_error > 0 ){
                $return['message'] = 'Error: There was an error submitting one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.';
            }elseif( $image_error > 0 ){
                $return['message'] = 'Error: There was an error submitting one of the Image. Go to "Manage Product" to fix it.';
            }else{
                // New product mail to be sent to the seller
                $this->session->unset_userdata('category_id');
                $return['status'] = 'success';
                $return['message'] = 'Success: Your product has been created, awaiting reviews and approval. You will be notified via email.';
                $this->session->set_flashdata('success_msg', 'Success: Your product has been created, awaiting reviews and approval. You will be notified via email.' );
            }
            echo json_encode($return);
            exit;
        }
    }


    function upload_image( $filepath, $product_name ){
        $this->load->library('cloudinarylib');
        $return = \Cloudinary\Uploader::upload( $filepath, 
                            array("tags" => $product_name, 
                                "resource_type" => "image",
                                "eager" => array(
                                    array("width" => 500, "height" => 500, "crop" => "pad")
                                )
                            )
                        );
        return $return;
    }

    /**
     * @param int : root_category_id
     * @return:  JSON categories id, name
     */
    function append_category(){
        if( $this->input->is_ajax_request() && $this->input->post() ){
            $id = $this->input->post('id');
            if( $id == '' ){
                $return = array();
                echo json_encode( $return );
                exit;
            }
            $results = $this->seller->get_category_children($id);
            $return = array();
            foreach( $results as $result ){
                $res['has_child'] = 0;
                $res['id'] = $result->id;
                $res['name'] = $result->name;
                if( $this->seller->has_child( $result->id) ) {
                    $res['has_child'] = 1;
                }
                array_push( $return , $res );
            }
            echo json_encode($return, JSON_UNESCAPED_SLASHES);
            exit;
        }else{
            redirect(base_url());
        }
    }


    // upload function
    function do_upload($file, $id =''){
        $config['upload_path']          = "./data/products/$id/";
        $config['allowed_types']        = 'gif|jpg|png|JPEG|jpeg|bmp';
        $config['max_size']             = 10048;
        $config['max_width']            = 2000;
        $config['max_height']           = 2000;
        $config['overwrite']            = false;
        $config['encrypt_name']         = true;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload( $file )){
            // could append the file name...
            return $this->upload->display_errors();
            return false;
        }else{
            return $this->upload->data('file_name');
        }
    }

    public function edit($id = ''){

        $id = cleanit($id);
        if( !$this->input->post() ){
            $uid = base64_decode($this->session->userdata('logged_id'));
            $page_data['pg_name'] = 'product';
            $page_data['sub_name'] = 'edit_product';
            $page_data['profile'] = $this->seller->get_profile_details($uid,
                'first_name,last_name,email,profile_pic');
            // check the owner
            if( $this->seller->is_product_owner( $uid, $id ) < 1 ){
                $this->session->set_flashdata('error_msg', 'Info. : The product you are trying to access is not available to you.');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $page_data['product'] = $this->seller->get_row( 'products', '*', "( id = {$id})");
            $category_id = $page_data['product']->category_id;
            $spec_result  = $this->seller->get_parent_details($category_id);
            $specification_array = $categories_name = array();

            foreach( $spec_result as $result ){
                $categories_name[] = $result->name;
                if( $result->specifications !== '' ) {
                    $decode = json_decode( $result->specifications );
                    $x = 0;
                    $spec_array = array();
                    foreach( $decode as $key => $value ) {
                        $specification = $this->seller->get_specifications( $value );
                        if( $specification ) {
                            $spec_array['category_name'] = $result->name;
                            $spec_array['description'] = $result->description;
                            $spec_array['specifications'][$x]['spec_id']  = $value;
                            $spec_array['specifications'][$x]['spec_name'] = $specification->spec_name;
                            $spec_array['specifications'][$x]['spec_options'] = $specification->options;
                            $spec_array['specifications'][$x]['multiple_options'] = $specification->multiple_options;
                            $spec_array['specifications'][$x]['spec_description'] = $specification->description;
                            $x++;
                        }
                    }
                    array_push( $specification_array, $spec_array);
                }
            }

            $page_data['categories_name'] = $categories_name;
            $page_data['features'] = $specification_array;
            $category_details = $this->seller->get_row('categories', 'variation_name, variation_options', "( id = {$category_id})");
            $option_array = array();
            if( !empty($category_details->variation_options) ){
                $options = json_decode( $category_details->variation_options);
                foreach( $options as $option ){
                    $option_name = $this->seller->get_row('options', 'name', " (id = {$option})")->name;
                    array_push( $option_array, $option_name);
                }
            }

            $page_data['variation_name'] = $category_details->variation_name;
            $page_data['variation_options'] = $option_array;
            $page_data['variations'] = $this->seller->get_results('product_variation', '*', "( product_id = {$id})");
            $page_data['product_id'] = $id;
            $page_data['page_title'] = 'Edit product ( ' . $page_data['product']->product_name .' )';
            $page_data['brands'] = $this->seller->get_results('brands');
            $this->load->view('seller/edit', $page_data);
        }else{            
            // Process
            $id = $this->input->post('product_id');
            $pricing_error = $image_error = 0;
            $return['status'] = 'error';
            $return['message'] = '';
            // Product Block
            $certifications = $this->input->post('certifications');
            $certifications = (!empty($certifications) ) ? json_encode($certifications) : '';
            $warranty_type = $this->input->post('warranty_type');
            $warranty_type = ( !empty($warranty_type) ) ? json_encode( $warranty_type ) : '';
            $colour_family = $this->input->post('colour_family');
            $colour_family = ( !empty( $colour_family) ) ? json_encode( $colour_family ) : '';
            $description = $this->input->post('product_description');
            $product_table = array(
                'product_name' => cleanit($this->input->post('product_name')),
                'brand_name' => cleanit($this->input->post('brand_name')),
                'model' => cleanit($this->input->post('model')),
                'main_colour' => $this->input->post('main_colour'),
                'product_description' => htmlentities( $description, ENT_QUOTES),
                'youtube_id' => cleanit($this->input->post('youtube_id')),
                'in_the_box' => htmlentities($this->input->post('in_the_box'), ENT_QUOTES),
                'highlights' => htmlentities($this->input->post('highlights'), ENT_QUOTES),
                'product_line' => cleanit( $this->input->post('product_line')),
                'colour_family' => $colour_family,
                'main_material' => $this->input->post('main_material'),
                'dimensions' => cleanit($this->input->post('dimensions')),
                'weight'    => cleanit($this->input->post('weight')),
                'product_warranty' => htmlentities($this->input->post('product_warranty') , ENT_QUOTES),
                'warranty_type' => $warranty_type,
                'warranty_address' => $this->input->post('warranty_address'),
                'certifications' => $certifications,
                'product_status' => 'pending'
            );
            //     Product Features Block
            // Since we are getting the specification name; we loop through the specification json
            // SELECT id FROM specifications WHERE spec_name = 'POST_KEY'
            $attributes = array();
            foreach($_POST as $post => $value ){
                if( substr_compare('attribute_',$post,0,10 ) == 0 ){
                    // we found a match
                    // check if its a multiple
//                    {"Features":[" Anti Glare"],"Display":"gps"}
                    // @TODO: fix the multiple value
                    $feature_name = explode('_', $post);
                    if( is_array($post) && !empty($value)){
                        $x= json_encode($value);
                        $attributes[$feature_name[1]] = json_encode(json_decode($x));
                    }elseif(!empty($value)){
                        $attributes[$feature_name[1]] = trim($value);
                    }
                }
            }
            
            $product_table['attributes'] = json_encode($attributes);
            // update product table
            $product_id  = $this->seller->update_data(array('id' => $id ), $product_table, 'products');
            // Product Variation Block
            $count_check = sizeof($this->input->post('sale_price'));
            // Declare all variables
            $variation = $this->input->post('variation');
            $isbn = $this->input->post('isbn');
            $sku = $this->input->post('sku');
            $quantity = $this->input->post('quantity');
            $sale_price = $this->input->post('sale_price');
            $discount_price = $this->input->post('discount_price');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $variation_id = $this->input->post('variation_id');
            if( $count_check > 0 ){
                for( $i = 0; $i < $count_check; $i++ ){
                    $variation_id                 =   $variation_id[$i];                    
                    $variation_data['variation'] = $variation[$i];
                    $variation_data['sku']      = $sku[$i];
                    $variation_data['isbn']     = $isbn[$i];
                    $variation_data['quantity']  = $quantity[$i];
                    $variation_data['sale_price'] = $sale_price[$i];
                    $variation_data['discount_price'] = $discount_price[$i];
                    $variation_data['start_date'] = $start_date[$i];
                    $variation_data['end_date'] = $end_date[$i];

                    // little validation
                    if( $variation_data['quantity'] > 10 ) $variation_data['quantity'] = 10;

                    if( empty($variation_data['discount_price']) ) { $variation_data['start_date'] = $variation_data['end_date'] ='';}
                    if( $variation_id == 'new' ){
                        $variation_data['product_id'] = $product_id;
                        $this->seller->insert_data('product_variation', $variation_data);
                    }else{
                        $this->seller->update_data(array('id' => $variation_id ), $variation_data, 'product_variation');
                    }
                    // if( !$this->seller->update_data(array('product_id' => $id ), $variation_data, 'product_variation') ){
                    //     throw new Exception( 'There was an error updating the variation' . $this->seller->insert_data('product_variation', $variation_data));
                    // }
                }
            }

            // Product Gallery Block
            if( isset($_FILES) && !empty($_FILES)){
                $counts = sizeof($_FILES['file']['tmp_name']);
                $product_gallery = array();
                $files = $_FILES;
                for ( $x = 0; $x < $counts; $x++ ){
                    $old_name = $files['file']['name'][$x];
                    $_FILES['file']['name']= $files['file']['name'][$x];
                    $_FILES['file']['type']= $files['file']['type'][$x];
                    $_FILES['file']['tmp_name']= $files['file']['tmp_name'][$x];
                    $_FILES['file']['error']= $files['file']['error'][$x];
                    $_FILES['file']['size']= $files['file']['size'][$x];

                    // check if we have the file already uploaded
                    if( file_exists(realpath('./data/products/'. $id.'/'.$old_name)) ) {
                        $product_gallery['image_name'] = $upload_result;
                        $product_gallery['featured_image'] = ( isset($_POST['featured_image']) && ($old_name == $_POST['featured_image'] )) ? 1 : 0;
                        if( $counts == 1 ) $product_gallery['featured_image'] = 1;
                        // Updating the image by its name
                        if( !$this->seller->update_data(array('name' => $old_name ), $product_gallery, 'product_gallery')){
                            $image_error++;
                        }
                    }else{
                        // we have a new file to upload
                        $upload_result = $this->do_upload('file', $id);
                        if( $upload_result ){
                            $product_gallery = array(
                                'product_id'    => $id,
                                'seller_id' => base64_decode($this->session->userdata('logged_id')),
                                'created_at' => get_now()
                            );
                            $product_gallery['image_name'] = $upload_result;
                            $product_gallery['featured_image'] = ( isset($_POST['featured_image']) && ($old_name == $_POST['featured_image'] )) ? 1 : 0;
                            if( $counts == 1 ) $product_gallery['featured_image'] = 1;
                            if(  !is_int($this->seller->insert_data('product_gallery', $product_gallery)) ){
                                $image_error++;
                            }
                        }else{
                            $image_error++;
                        }
                    }

                }// end of for loop

            }

            // Check for errors
            if( $pricing_error > 0 ){
                $return['message'] = 'Error: There was an error updating one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.';
            }elseif( $image_error > 0 ){
                $return['message'] = 'Error: There was an error updating one of the Image. Go to "Manage Product" to fix it.';
            }else{
                // New product mail to be sent to the seller
                $return['status'] = 'success';
                $return['message'] = 'Success: Your product has been updated, awaiting reviews and approval. You will be notified via email.';
            }
            $this->session->set_flashdata($return['status'].'_msg', $return['message']);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function load_images( $id = ''){
        
        $galleries = $this->seller->get_product_gallery($id);
        $result = array();
        foreach( $galleries as $gallery){
            $img_name = $gallery->image_name;
            $obj['filename'] = $img_name;
            $obj['fileURL'] = base_url('data/products/' . $id . '/' . $img_name);
            $obj['filesize'] = filesize(realpath('./data/products/'. $id.'/'.$img_name));
            $obj['featured'] = $gallery->featured_image;
            $result[] = $obj;
        }
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($result);
        exit;
    }


}