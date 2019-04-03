<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->input->post('category_id')) {
            $category_id = $this->input->post('category_id');
            $this->session->set_userdata(array('category_id' => $category_id));
            redirect('product/create');
        } else {
            // Unset the category
            $this->session->unset_userdata('category_id');
            $uid = $this->session->userdata('logged_id');
            $page_data['page_title'] = 'Choose Category';
            $page_data['pg_name'] = 'product';
            $page_data['sub_name'] = 'select_category';
            $page_data['profile'] = $this->seller->get_profile_details($uid,
                'first_name,last_name,email,profile_pic');
            $page_data['categories'] = $this->seller->get_results('categories', 'id,name', "( pid = 0 )");
            $this->load->view('choose_category', $page_data);
        }
    }

    public function create()
    {
        // check if we have the category session set
        if ($this->session->has_userdata('category_id')) {
            $sub_id = $this->session->userdata('category_id');
            $spec_result = $this->seller->get_parent_details($sub_id);
            $specification_array = $categories_name = array();
            foreach ($spec_result as $result) {
                $categories_name[] = $result->name;
                if ($result->specifications !== '') {
                    $decode = json_decode($result->specifications);
                    $x = 0;
                    $spec_array = array();
                    foreach ($decode as $key => $value) {
                        $specification = $this->seller->get_specifications($value);
                        if ($specification) {
                            $spec_array['category_name'] = $result->name;
                            $spec_array['description'] = $result->description;
                            $spec_array['specifications'][$x]['spec_id'] = $value;
                            $spec_array['specifications'][$x]['spec_name'] = $specification->spec_name;
                            $spec_array['specifications'][$x]['spec_options'] = $specification->options;
                            $spec_array['specifications'][$x]['multiple_options'] = $specification->multiple_options;
                            $spec_array['specifications'][$x]['spec_description'] = $specification->description;
                            $x++;
                        }
                    }
                    array_push($specification_array, $spec_array);
                }
            }
            $page_data['categories_name'] = $categories_name;
            $page_data['features'] = $specification_array;
            // Check if post method
            $uid = $this->session->userdata('logged_id');
            $page_data['page_title'] = 'Add product';
            $page_data['pg_name'] = 'product';
            $page_data['sub_name'] = 'add_product';
            $page_data['profile'] = $this->seller->get_profile_details($uid,
                'first_name,last_name,email,profile_pic');
            $legal_company_name = $this->seller->get_row('sellers', 'legal_company_name', "( uid = {$uid})");
            $page_data['store_name'] = ($legal_company_name) ? $legal_company_name->legal_company_name : '';
            $page_data['brands'] = $this->seller->get_results('brands', "brand_name,description", array('status' => 1));
            $category_details = $this->seller->get_row('categories', 'variation_name, variation_options', "( id = {$sub_id})");
            $option_array = array();
            if (!empty($category_details->variation_options)) {
                $options = json_decode($category_details->variation_options);
                foreach ($options as $option) {
                    $option_name = $this->seller->get_row('options', 'name', " (id = {$option})")->name;
                    array_push($option_array, $option_name);
                }
            }
            $page_data['variation_name'] = $category_details->variation_name;
            $page_data['variation_options'] = $option_array;
            $this->load->view('create', $page_data);
        } else {
            // redirect to make a selection of category
            $this->session->set_flashdata('error_msg', 'Info. : You need to Select a Category first for the product.');
            redirect('product');
        }
    }

    public function first_insert_draft()
    {
        if ($this->input->post() || isset($_FILES)) {
            //var_dump($_POST);exit;
            $pricing_error = $image_error = 0;
            $return['status'] = 'error';
            $return['message'] = '';
            $message = '';
            // Product Block
            $certifications = $this->input->post('certifications');
            $certifications = (!empty($certifications)) ? json_encode($certifications) : '[]';
            $warranty_type = $this->input->post('warranty_type');
            $warranty_type = (!empty($warranty_type)) ? json_encode($warranty_type) : '[]';
            $colour_family = $this->input->post('colour_family');
            $colour_family = (!empty($colour_family)) ? json_encode($colour_family) : '[]';
            $sku = $this->product->generate_code();
            $product_description = '<div class="prod_description">' . $this->input->post('product_description', true) . '</div>';
            $in_the_box = '<div class="prod_description">' . $this->input->post('in_the_box', true). '</div>';
            $highlights = '<div class="prod_description">' . $this->input->post('highlights', true) .'</div>';
            $product_warranty = '<div class="prod_description">'. $this->input->post('product_warranty', true) .'</div>';
            $warranty_address = nl2br($this->input->post('warranty_address', true));
            $from_overseas = ($this->input->post('from_overseas') == 'on') ? 1 : 0;

            $product_name = cleanit($this->input->post('product_name'));
            $brand_name = cleanit($this->input->post('brand_name'));
//            if ($brand_name == 'others') $product_name = 'generic ' . $product_name;
            $product_table = array(
                'seller_id' => $this->session->userdata('logged_id'),
                'sku' => $sku,
                'category_id' => $this->input->post('category_id'),
                'product_name' => $product_name,
                'brand_name' => $brand_name,
                'model' => cleanit($this->input->post('model')),
                'main_colour' => $this->input->post('main_colour'),
                'product_description' => $product_description,
                'youtube_id' => cleanit($this->input->post('youtube_id')),
                'in_the_box' => $in_the_box,
                'highlights' => $highlights,
                'product_line' => cleanit($this->input->post('product_line')),
                'colour_family' => $colour_family,
                'main_material' => $this->input->post('main_material'),
                'dimensions' => cleanit($this->input->post('dimensions')),
                'weight' => cleanit($this->input->post('weight')),
                'product_warranty' => $product_warranty,
                'warranty_type' => $warranty_type,
                'warranty_address' => $warranty_address,
                'certifications' => $certifications,
                'product_status' => 'draft',
                'from_overseas' => $from_overseas,
                'created_on' => get_now()
            );

            // Product Features Block
            // Since we are getting the specification name; we loop through the specification json
            // SELECT id FROM specifications WHERE spec_name = 'POST_KEY'
            $attributes = array();
            foreach ($_POST as $post => $value) {
                if (substr_compare('attribute_', $post, 0, 10) == 0) {
                    $feature_name = explode('_', $post);
                    if (is_array($post) && !empty($value)) {
                        $value = trim($value);
                        $x = json_encode($value);
                        $attributes[$feature_name[1]] = json_encode(json_decode($x));
                    } elseif (!empty($value)) {
                        $attributes[$feature_name[1]] = trim(strtolower($value));
                    }
                }
            }
            $product_table['attributes'] = json_encode($attributes);
            // Lets start transaction
            try {
                $this->db->trans_begin();

                $product_id = $this->seller->insert_data('products', $product_table);

            } catch (Exception $e) {
                $return['message'] = 'Error: There was an error posting your product, if error persist please contact support. Thanks.';
                $this->session->set_flashdata('error_msg', 'There was an error posting your product, if error persist please contact support. Thanks');
                echo json_encode($return);
                exit;
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                // Check for errors
                if ($pricing_error > 0) {
                    $return['message'] = 'Error: There was an error submitting one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.');
                } elseif ($image_error > 0) {
                    $return['message'] = 'Error: There was an error submitting one of the Image. Go to "Manage Product" to fix it.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting one of the Image. Go to "Manage Product" to fix it.');
                } else {
                    $return['message'] = 'Error: There was an error submitting your product. Please try again or contact support.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting your product. Please try again or contact support.');
                }
            } else {
                $this->db->trans_commit();
                // New product mail to be sent to the seller
                //$this->session->unset_userdata('category_id');
                $return['temp_product_id'] = $product_id;
                $return['status'] = 'success';
                $return['message'] = 'Success: Your product has been saved.';
                $this->session->set_flashdata('success_msg', 'Success: Your product has been saved.');
            }

            // Unset the category session
            //$this->session->unset_userdata('category_id');
            echo json_encode($return);
            exit;
        }
    }

    public function other_update_draft()
    {
        if ($this->input->post() || isset($_FILES)) {
            $pricing_error = $image_error = 0;
            $return['status'] = 'error';
            $return['message'] = '';
            $message = '';
            // Product Block
            $certifications = $this->input->post('certifications');
            $id = $this->input->post('temp_product_id');
            $certifications = (!empty($certifications)) ? json_encode($certifications) : '[]';
            $warranty_type = $this->input->post('warranty_type');
            $warranty_type = (!empty($warranty_type)) ? json_encode($warranty_type) : '[]';
            $colour_family = $this->input->post('colour_family');
            $colour_family = (!empty($colour_family)) ? json_encode($colour_family) : '[]';
            $sku = $this->product->generate_code();
            $product_description = '<div class="prod_description">' . $this->input->post('product_description', true) . '</div>';
            $in_the_box = nl2br($this->input->post('in_the_box', true));
            $highlights = nl2br($this->input->post('highlights', true));
            $product_warranty = nl2br($this->input->post('product_warranty', true));
            $warranty_address = nl2br($this->input->post('warranty_address', true));
            $from_overseas = ($this->input->post('from_overseas') == 'on') ? 1 : 0;

            $product_name = cleanit($this->input->post('product_name'));
            $brand_name = cleanit($this->input->post('brand_name'));
//            if ($brand_name != 'others') $product_name = $brand_name . ' ' . $product_name;
            $product_table = array(
                'seller_id' => $this->session->userdata('logged_id'),
                'sku' => $sku,
                'category_id' => $this->input->post('category_id'),
                'product_name' => $product_name,
                'brand_name' => $brand_name,
                'model' => cleanit($this->input->post('model')),
                'main_colour' => $this->input->post('main_colour'),
                'product_description' => $product_description,
                'youtube_id' => cleanit($this->input->post('youtube_id')),
                'in_the_box' => $in_the_box,
                'highlights' => $highlights,
                'product_line' => cleanit($this->input->post('product_line')),
                'colour_family' => $colour_family,
                'main_material' => $this->input->post('main_material'),
                'dimensions' => cleanit($this->input->post('dimensions')),
                'weight' => cleanit($this->input->post('weight')),
                'product_warranty' => $product_warranty,
                'warranty_type' => $warranty_type,
                'warranty_address' => $warranty_address,
                'certifications' => $certifications,
                'product_status' => 'draft',
                'from_overseas' => $from_overseas
            );

            // Product Features Block
            // Since we are getting the specification name; we loop through the specification json
            // SELECT id FROM specifications WHERE spec_name = 'POST_KEY'
            $attributes = array();
            foreach ($_POST as $post => $value) {
                if (substr_compare('attribute_', $post, 0, 10) == 0) {
                    $feature_name = explode('_', $post);
                    if (is_array($post) && !empty($value)) {
                        $value = trim($value);
                        $x = json_encode($value);
                        $attributes[$feature_name[1]] = json_encode(json_decode($x));
                    } elseif (!empty($value)) {
                        $attributes[$feature_name[1]] = trim(strtolower($value));
                    }
                }
            }
            $product_table['attributes'] = json_encode($attributes);
            // Lets start transaction
            try {
                $this->db->trans_begin();
                $this->seller->update_data(array('id' => $id), $product_table, 'products');
                // Product Variation Block
                $check = $this->input->post('sale_price', true);
                //$count_check = count($check);
                //var_dump($count_check);exit;
                // Declare all variables
                $variation = $this->input->post('variation', true);
                $sku = $this->input->post('sku', true);
                $quantity = $this->input->post('quantity', true);
                $sale_price = $this->input->post('sale_price', true);
                $discount_price = $this->input->post('discount_price', true);
                $start_date = $this->input->post('start_date');
                $end_date = $this->input->post('end_date');
                $variation_id = $this->input->post('variation_id');
                $var_ret_id_array = array();
                if (isset($_POST['sale_price']) && !empty($check[0])) {
                    $count_check = count($this->input->post('sale_price'));
                    for ($i = 0; $i < $count_check; $i++) {
                        $variation_id['id'] = $variation_id[$i];
                        $variation_data['variation'] = cleanit($variation[$i]);
                        $variation_data['sku'] = cleanit($sku[$i]);
                        $variation_data['quantity'] = cleanit($quantity[$i]);
                        $variation_data['sale_price'] = cleanit($sale_price[$i]);
                        $variation_data['discount_price'] = cleanit($discount_price[$i]);
                        $variation_data['start_date'] = $start_date[$i];
                        $variation_data['end_date'] = $end_date[$i];
                        if ($variation_data['quantity'] < 1) $variation_data['quantity'] = 10;

                        if ($variation_id['id'] == 'new') {
                            $variation_data['product_id'] = $id;
                            $var_ret_id = $this->seller->insert_data('product_variation', $variation_data);
                            array_push($var_ret_id_array, $var_ret_id);
                        } else {
                            $this->seller->update_data(array('id' => $variation_id['id']), $variation_data, 'product_variation');
                        }

                    }
                }
                // Product Gallery Block
                if (isset($_FILES) && !empty($_FILES) && count($_FILES)) {
                    $counts = sizeof($_FILES['edit_image_file']['tmp_name']);
                    $product_gallery = array();
                    $files = $_FILES;
                    for ($x = 0; $x < $counts; $x++) {
                        $old_name['old_name'] = $files['edit_image_file']['name'][$x];
                        $_FILES['edit_image_file']['name'] = $files['edit_image_file']['name'][$x];
                        $_FILES['edit_image_file']['type'] = $files['edit_image_file']['type'][$x];
                        $_FILES['edit_image_file']['tmp_name'] = $files['edit_image_file']['tmp_name'][$x];
                        $_FILES['edit_image_file']['error'] = $files['edit_image_file']['error'][$x];
                        $_FILES['edit_image_file']['size'] = $files['edit_image_file']['size'][$x];
                        // check if we have the file already uploaded
                        if ($this->curl_get_file_size(PRODUCTS_IMAGE_PATH . $old_name['old_name']) == ''
                            || $this->curl_get_file_size(PRODUCTS_IMAGE_PATH . $old_name['old_name']) == 'unknown') {
                            $product_gallery['featured_image'] = (isset($_POST['featured_image']) && ($old_name['old_name'] == $_POST['featured_image'])) ? 1 : 0;
                            if ($counts == 1) $product_gallery['featured_image'] = 1;
                            // Update
                            $this->seller->update_data(array('image_name' => $old_name['old_name']), $product_gallery, 'product_gallery');
                        } else {
                            if ($_FILES['edit_image_file']['name'] != '') {
                                // we have a new file to upload
                                $image_upload_array = array(
                                    'folder' => PRODUCT_IMAGE_FOLDER,
                                    'filepath' => $_FILES['edit_image_file']['tmp_name'],
                                    'eager' => array("width" => 630, "height" => 570, "crop" => "fill")
                                );
                                $this->cloudinarylib->upload_image($image_upload_array);
                                $image_name = $this->cloudinarylib->get_result();
                                if ($image_name) {
                                    $product_gallery = array(
                                        'product_id' => $id,
                                        'seller_id' => $this->session->userdata('logged_id'),
                                        'created_at' => get_now()
                                    );
                                    $product_gallery['image_name'] = $image_name;
                                    if ($counts == 1) $product_gallery['featured_image'] = 1;
                                    if (!is_int($this->seller->insert_data('product_gallery', $product_gallery))) {
                                        $image_error++;
                                    }
                                } else {
                                    $image_error++;
                                }
                            }
                        }
                    }// end of for loop
                }

            } catch (Exception $e) {
                $return['message'] = 'Error: There was an error posting your product, if error persist please contact support. Thanks.';
                $this->session->set_flashdata('error_msg', 'There was an error posting your product, if error persist please contact support. Thanks');
                echo json_encode($return);
                exit;
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                // Check for errors
                if ($pricing_error > 0) {
                    $return['message'] = 'Error: There was an error submitting one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.');
                } elseif ($image_error > 0) {
                    $return['message'] = 'Error: There was an error submitting one of the Image. Go to "Manage Product" to fix it.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting one of the Image. Go to "Manage Product" to fix it.');
                } else {
                    $return['message'] = 'Error: There was an error submitting your product. Please try again or contact support.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting your product. Please try again or contact support.');
                }
            } else {
                $this->db->trans_commit();
                // New product mail to be sent to the seller
                //$this->session->unset_userdata('category_id');
                $return['variations_id'] = $var_ret_id_array;
                $return['status'] = 'success';
                $return['message'] = 'Success: Your product has been saved.';
                $this->session->set_flashdata('success_msg', 'Success: Your product has been saved.');
            }

            // Unset the category session
            //$this->session->unset_userdata('category_id');
            echo json_encode($return);
            exit;
        }
    }

    public function auto_process()
    {
        if ($this->input->post() || isset($_FILES)) {
            $pricing_error = $image_error = 0;
            $return['status'] = 'error';
            $return['message'] = '';
            $message = '';
            // Product Block
            $certifications = $this->input->post('certifications');
            $id = $this->input->post('temp_product_id');
            $certifications = (!empty($certifications)) ? json_encode($certifications) : '[]';
            $warranty_type = $this->input->post('warranty_type');
            $warranty_type = (!empty($warranty_type)) ? json_encode($warranty_type) : '[]';
            $colour_family = $this->input->post('colour_family');
            $colour_family = (!empty($colour_family)) ? json_encode($colour_family) : '[]';
            $sku = $this->product->generate_code();
            $product_description = '<div class="prod_description">' . $this->input->post('product_description', true) . '</div>';
            $in_the_box = nl2br($this->input->post('in_the_box', true));
            $highlights = nl2br($this->input->post('highlights', true));
            $product_warranty = nl2br($this->input->post('product_warranty', true));
            $warranty_address = nl2br($this->input->post('warranty_address', true));
            $from_overseas = ($this->input->post('from_overseas') === true) ? 1 : 0;

            $product_name = cleanit($this->input->post('product_name'));
            $brand_name = cleanit($this->input->post('brand_name'));
//            if ($brand_name == 'others') $product_name = 'generic ' . $product_name;
            $product_table = array(
                'seller_id' => $this->session->userdata('logged_id'),
                'sku' => $sku,
                'category_id' => $this->input->post('category_id'),
                'product_name' => $product_name,
                'brand_name' => $brand_name,
                'model' => cleanit($this->input->post('model')),
                'main_colour' => $this->input->post('main_colour'),
                'product_description' => $product_description,
                'youtube_id' => cleanit($this->input->post('youtube_id')),
                'in_the_box' => $in_the_box,
                'highlights' => $highlights,
                'product_line' => cleanit($this->input->post('product_line')),
                'colour_family' => $colour_family,
                'main_material' => $this->input->post('main_material'),
                'dimensions' => cleanit($this->input->post('dimensions')),
                'weight' => cleanit($this->input->post('weight')),
                'product_warranty' => $product_warranty,
                'warranty_type' => $warranty_type,
                'warranty_address' => $warranty_address,
                'certifications' => $certifications,
                'product_status' => 'pending',
                'from_overseas' => $from_overseas
            );

            // Product Features Block
            // Since we are getting the specification name; we loop through the specification json
            // SELECT id FROM specifications WHERE spec_name = 'POST_KEY'
            $attributes = array();
            foreach ($_POST as $post => $value) {
                if (substr_compare('attribute_', $post, 0, 10) == 0) {
                    $feature_name = explode('_', $post);
                    if (is_array($post) && !empty($value)) {
                        $value = trim($value);
                        $x = json_encode($value);
                        $attributes[$feature_name[1]] = json_encode(json_decode($x));
                    } elseif (!empty($value)) {
                        $attributes[$feature_name[1]] = trim(strtolower($value));
                    }
                }
            }
            $product_table['attributes'] = json_encode($attributes);
            // Lets start transaction
            try {
                $this->db->trans_begin();
                $this->seller->update_data(array('id' => $id), $product_table, 'products');
                // Product Variation Block
                $check = $this->input->post('sale_price', true);
                //$count_check = count($check);
                //var_dump($count_check);exit;
                // Declare all variables
                $variation = $this->input->post('variation', true);
                $sku = $this->input->post('sku', true);
                $quantity = $this->input->post('quantity', true);
                $sale_price = $this->input->post('sale_price', true);
                $discount_price = $this->input->post('discount_price', true);
                $start_date = $this->input->post('start_date');
                $end_date = $this->input->post('end_date');
                $variation_id = $this->input->post('variation_id');
                //$var_ret_id_array = array();
                if (isset($_POST['sale_price']) && !empty($check[0])) {
                    $count_check = count($this->input->post('sale_price'));
                    for ($i = 0; $i < $count_check; $i++) {
                        $variation_id['id'] = $variation_id[$i];
                        $variation_data['variation'] = cleanit($variation[$i]);
                        $variation_data['sku'] = cleanit($sku[$i]);
                        $variation_data['quantity'] = cleanit($quantity[$i]);
                        $variation_data['sale_price'] = cleanit($sale_price[$i]);
                        $variation_data['discount_price'] = cleanit($discount_price[$i]);
                        $variation_data['start_date'] = $start_date[$i];
                        $variation_data['end_date'] = $end_date[$i];
                        if ($variation_data['quantity'] < 1) $variation_data['quantity'] = 10;

                        if ($variation_id['id'] == 'new') {
                            $variation_data['product_id'] = $id;
                            $var_ret_id = $this->seller->insert_data('product_variation', $variation_data);
                            //array_push($var_ret_id_array, $var_ret_id);
                        } else {
                            $this->seller->update_data(array('id' => $variation_id['id']), $variation_data, 'product_variation');
                        }

                    }
                }
                // Product Gallery Block
                if (isset($_FILES)) {
                    $counts = sizeof($_FILES['file']['tmp_name']);
                    $product_gallery = array(
                        'product_id' => $id,
                        'seller_id' => $this->session->userdata('logged_id'),
                        'created_at' => get_now()
                    );
                    $files = $_FILES;
                    for ($x = 0; $x < $counts; $x++) {
                        $old_name = $files['file']['name'][$x];
                        $_FILES['file']['name'] = $files['file']['name'][$x];
                        $_FILES['file']['type'] = $files['file']['type'][$x];
                        $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$x];
                        $_FILES['file']['error'] = $files['file']['error'][$x];
                        $_FILES['file']['size'] = $files['file']['size'][$x];

                        $image_upload_array = array(
                            'folder' => PRODUCT_IMAGE_FOLDER,
                            'filepath' => $_FILES['file']['tmp_name'],
                            'eager' => array("width" => 630, "height" => 570, "crop" => "fill")
                        );

                        $this->cloudinarylib->upload_image($image_upload_array);
                        $image_name = $this->cloudinarylib->get_result('filename');

                        $product_gallery['image_name'] = $image_name;

                        $product_gallery['featured_image'] = (isset($_POST['featured_image']) && ($old_name == $_POST['featured_image'])) ? 1 : 0;
                        if ($counts == 1) $product_gallery['featured_image'] = 1;
                        if (!$this->seller->insert_data('product_gallery', $product_gallery)) {
                            $image_error++;
                        }
                        unset($_FILES['file']['tmp_name']);
                        unset($image_upload_array);
                    }// end of for loop
                }

            } catch (Exception $e) {
                $return['message'] = 'Error: There was an error posting your product, if error persist please contact support. Thanks.';
                $this->session->set_flashdata('error_msg', 'There was an error posting your product, if error persist please contact support. Thanks');
                echo json_encode($return);
                exit;
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                // Check for errors
                if ($pricing_error > 0) {
                    $return['message'] = 'Error: There was an error submitting one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.');
                } elseif ($image_error > 0) {
                    $return['message'] = 'Error: There was an error submitting one of the Image. Go to "Manage Product" to fix it.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting one of the Image. Go to "Manage Product" to fix it.');
                } else {
                    $return['message'] = 'Error: There was an error submitting your product. Please try again or contact support.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting your product. Please try again or contact support.');
                }
            } else {
                $this->db->trans_commit();
                // New product mail to be sent to the seller
                $this->session->unset_userdata('category_id');
                $return['status'] = 'success';
                $return['message'] = 'Success: Your product has been created, awaiting reviews and approval. You will be notified via email.';
                $this->session->set_flashdata('success_msg', 'Success: Your product has been created, awaiting reviews and approval. You will be notified via email.');
            }

            // Unset the category session
            $this->session->unset_userdata('category_id');
            echo json_encode($return);
            exit;
        }
    }

    public function process()
    {
        if ($this->input->post() || isset($_FILES)) {
            $pricing_error = $image_error = 0;
            $return['status'] = 'error';
            $return['message'] = '';
            $message = '';
            // Product Block
            $certifications = $this->input->post('certifications');
            $certifications = (!empty($certifications)) ? json_encode($certifications) : '[]';
            $warranty_type = $this->input->post('warranty_type');
            $warranty_type = (!empty($warranty_type)) ? json_encode($warranty_type) : '[]';
            $colour_family = $this->input->post('colour_family');
            $colour_family = (!empty($colour_family)) ? json_encode($colour_family) : '[]';
            $sku = $this->product->generate_code();
            $product_description = '<div class="prod_description">' . $this->input->post('product_description', true) . '</div>';
            $in_the_box = '<div class="prod_description">' . $this->input->post('in_the_box', true).'</div>';
            $highlights = '<div class="prod_description">'. $this->input->post('highlights', true). '</div>';
            $product_warranty = nl2br($this->input->post('product_warranty', true));
            $warranty_address = nl2br($this->input->post('warranty_address', true));
            $from_overseas = ($this->input->post('from_overseas') == 'on') ? 1 : 0;

            $product_name = cleanit($this->input->post('product_name'));
            $brand_name = cleanit($this->input->post('brand_name'));
//            if ($brand_name != 'others') $product_name = $brand_name . ' ' . $product_name;
            $product_table = array(
                'seller_id' => $this->session->userdata('logged_id'),
                'sku' => $sku,
                'category_id' => $this->input->post('category_id'),
                'product_name' => $product_name,
                'brand_name' => $brand_name,
                'model' => cleanit($this->input->post('model')),
                'main_colour' => $this->input->post('main_colour'),
                'product_description' => $product_description,
                'youtube_id' => cleanit($this->input->post('youtube_id')),
                'in_the_box' => $in_the_box,
                'highlights' => $highlights,
                'product_line' => cleanit($this->input->post('product_line')),
                'colour_family' => $colour_family,
                'main_material' => $this->input->post('main_material'),
                'dimensions' => cleanit($this->input->post('dimensions')),
                'weight' => cleanit($this->input->post('weight')),
                'product_warranty' => $product_warranty,
                'warranty_type' => $warranty_type,
                'warranty_address' => $warranty_address,
                'certifications' => $certifications,
                'product_status' => 'pending',
                'from_overseas' => $from_overseas,
                'created_on' => get_now()
            );

            // Product Features Block
            // Since we are getting the specification name; we loop through the specification json
            // SELECT id FROM specifications WHERE spec_name = 'POST_KEY'
            $attributes = array();
            foreach ($_POST as $post => $value) {
                if (substr_compare('attribute_', $post, 0, 10) == 0) {
                    $feature_name = explode('_', $post);
                    if (is_array($post) && !empty($value)) {
                        $value = trim($value);
                        $x = json_encode($value);
                        $attributes[$feature_name[1]] = json_encode(json_decode($x));
                    } elseif (!empty($value)) {
                        $attributes[$feature_name[1]] = trim(strtolower($value));
                    }
                }
            }
            $product_table['attributes'] = json_encode($attributes);
            // Lets start transaction
            try {
                $this->db->trans_begin();
                $product_id = $this->seller->insert_data('products', $product_table);
                // Product Variation Block
                $count_check = sizeof($this->input->post('sale_price'));
                // Declare all variables
                $variation = $this->input->post('variation');
                $sku = $this->input->post('sku');
                $quantity = $this->input->post('quantity');
                $sale_price = $this->input->post('sale_price');
                $discount_price = $this->input->post('discount_price');
                $start_date = $this->input->post('start_date');
                $end_date = $this->input->post('end_date');
                if( $discount_price == $sale_price ) $discount_price =  $start_date = $end_date = '';
                if( $discount_price == '' ) $start_date = $end_date = '';
                if ($count_check > 0) {
                    for ($i = 0; $i < $count_check; $i++) {
                        $variation_data['product_id'] = $product_id;
                        $variation_data['variation'] = $variation[$i];
                        $variation_data['sku'] = $sku[$i];
                        $variation_data['quantity'] = $quantity[$i];
                        $variation_data['sale_price'] = $sale_price[$i];
                        $variation_data['discount_price'] = $discount_price[$i];
                        $variation_data['start_date'] = $start_date[$i];
                        $variation_data['end_date'] = $end_date[$i];
                        if ($variation_data['quantity'] < 1) $variation_data['quantity'] = 10;
                        if (!is_int($this->seller->insert_data('product_variation', $variation_data))) {
                            $message = "There was an error inserting the product variation";
                        }
                    }
                }
                // Product Gallery Block
                if (isset($_FILES)) {
                    $counts = sizeof($_FILES['file']['tmp_name']);
                    $product_gallery = array(
                        'product_id' => $product_id,
                        'seller_id' => $this->session->userdata('logged_id'),
                        'created_at' => get_now()
                    );
                    $files = $_FILES;
                    for ($x = 0; $x < $counts; $x++) {
                        $old_name = $files['file']['name'][$x];
                        $_FILES['file']['name'] = $files['file']['name'][$x];
                        $_FILES['file']['type'] = $files['file']['type'][$x];
                        $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$x];
                        $_FILES['file']['error'] = $files['file']['error'][$x];
                        $_FILES['file']['size'] = $files['file']['size'][$x];

                        $image_upload_array = array(
                            'folder' => PRODUCT_IMAGE_FOLDER,
                            'filepath' => $_FILES['file']['tmp_name'],
                            'eager' => array("width" => 680, "height" => 680, "crop" => "fill")
                        );

                        $this->cloudinarylib->upload_image($image_upload_array);
                        $image_name = $this->cloudinarylib->get_result('filename');

                        $product_gallery['image_name'] = $image_name;

                        $product_gallery['featured_image'] = (isset($_POST['featured_image']) && ($old_name == $_POST['featured_image'])) ? 1 : 0;
                        if ($counts == 1) $product_gallery['featured_image'] = 1;
                        if (!$this->seller->insert_data('product_gallery', $product_gallery)) {
                            $image_error++;
                        }
                        unset($_FILES['file']['tmp_name']);
                        unset($image_upload_array);
                    }// end of for loop
                }

            } catch (Exception $e) {
                $return['message'] = 'Error: There was an error posting your product, if error persist please contact support. Thanks.';
                $this->session->set_flashdata('error_msg', 'There was an error posting your product, if error persist please contact support. Thanks');
                echo json_encode($return);
                exit;
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                // Check for errors
                if ($pricing_error > 0) {
                    $return['message'] = 'Error: There was an error submitting one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.');
                } elseif ($image_error > 0) {
                    $return['message'] = 'Error: There was an error submitting one of the Image. Go to "Manage Product" to fix it.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting one of the Image. Go to "Manage Product" to fix it.');
                } else {
                    $return['message'] = 'Error: There was an error submitting your product. Please try again or contact support.';
                    $this->session->set_flashdata('error_msg', 'Error: There was an error submitting your product. Please try again or contact support.');
                }
            } else {
                $this->db->trans_commit();
                // New product mail to be sent to the seller
                $this->session->unset_userdata('category_id');
                $return['status'] = 'success';
                $return['message'] = 'Success: Your product has been created, awaiting reviews and approval. You will be notified via email.';
                $this->session->set_flashdata('success_msg', 'Success: Your product has been created, awaiting reviews and approval. You will be notified via email.');
            }

            // Unset the category session
            $this->session->unset_userdata('category_id');
            echo json_encode($return);
            exit;
        }
    }


    /**
     * @param int : root_category_id
     * @return:  JSON categories id, name
     */
    function append_category()
    {
        if ($this->input->is_ajax_request() && $this->input->post()) {
            $id = $this->input->post('id');
            if ($id == '') {
                $return = array();
                echo json_encode($return);
                exit;
            }
            $results = $this->seller->get_category_children($id);
            $return = array();
            foreach ($results as $result) {
                $res['has_child'] = 0;
                $res['id'] = $result->id;
                $res['name'] = $result->name;
                if ($this->seller->has_child($result->id)) {
                    $res['has_child'] = 1;
                }
                array_push($return, $res);
            }
            echo json_encode($return, JSON_UNESCAPED_SLASHES);
            exit;
        } else {
            redirect(base_url());
        }
    }

    // upload function

    public function edit($id = '')
    {
        $id = cleanit($id);
        if (!$this->input->post()) {
            $uid = $this->session->userdata('logged_id');
            $page_data['pg_name'] = 'product';
            $page_data['sub_name'] = 'edit_product';
            $page_data['profile'] = $this->seller->get_profile_details($uid,
                'first_name,last_name,email,profile_pic');
            // check the owner
            if ($this->seller->is_product_owner($uid, $id) < 1) {
                $this->session->set_flashdata('error_msg', 'Info. : The product you are trying to access is not available to you.');
                redirect($_SERVER['HTTP_REFERER']);
            }
            $page_data['product'] = $this->seller->get_row('products', '*', "( id = {$id})");
            $category_id = $page_data['product']->category_id;
            $spec_result = $this->seller->get_parent_details($category_id);
            $specification_array = $categories_name = array();
            foreach ($spec_result as $result) {
                $categories_name[] = $result->name;
                if ($result->specifications !== '') {
                    $decode = json_decode($result->specifications);
                    $x = 0;
                    $spec_array = array();
                    foreach ($decode as $key => $value) {
                        $specification = $this->seller->get_specifications($value);
                        if ($specification) {
                            $spec_array['category_name'] = $result->name;
                            $spec_array['description'] = $result->description;
                            $spec_array['specifications'][$x]['spec_id'] = $value;
                            $spec_array['specifications'][$x]['spec_name'] = $specification->spec_name;
                            $spec_array['specifications'][$x]['spec_options'] = $specification->options;
                            $spec_array['specifications'][$x]['multiple_options'] = $specification->multiple_options;
                            $spec_array['specifications'][$x]['spec_description'] = $specification->description;
                            $x++;
                        }
                    }
                    array_push($specification_array, $spec_array);
                }
            }
            $page_data['categories_name'] = $categories_name;
            $page_data['features'] = $specification_array;
            $category_details = $this->seller->get_row('categories', 'variation_name, variation_options', "( id = {$category_id})");
            $option_array = array();
            if (!empty($category_details->variation_options)) {
                $options = json_decode($category_details->variation_options);
                foreach ($options as $option) {
                    $option_name = $this->seller->get_row('options', 'name', " (id = {$option})")->name;
                    array_push($option_array, $option_name);
                }
            }
            $page_data['variation_name'] = $category_details->variation_name;
            $page_data['variation_options'] = $option_array;
            $page_data['variations'] = $this->seller->get_results('product_variation', '*', array('product_id' => $id));
            $page_data['product_id'] = $id;
            $page_data['page_title'] = 'Edit product ( ' . $page_data['product']->product_name . ' )';
            $page_data['brands'] = $this->seller->get_results('brands', "brand_name,description", array('status' => 1));
            $this->load->view('edit', $page_data);
        } else {
            // Process

            $id = $this->input->post('product_id');
            $pricing_error = $image_error = 0;
            $return['status'] = 'error';
            $return['message'] = '';
            // Product Block
            $certifications = $this->input->post('certifications');
            $certifications = (!empty($certifications)) ? json_encode($certifications) : '[]';
            $warranty_type = $this->input->post('warranty_type');
            $warranty_type = (!empty($warranty_type)) ? json_encode($warranty_type) : '[]';
            $colour_family = $this->input->post('colour_family');
            $colour_family = (!empty($colour_family)) ? json_encode($colour_family) : '[]';
            $description = nl2br(trim($this->input->post('product_description', true)));
            $in_the_box = nl2br($this->input->post('in_the_box', true));
            $highlights = nl2br($this->input->post('highlights', true));
            $product_warranty = nl2br($this->input->post('product_warranty', true));
            $warranty_address = nl2br($this->input->post('warranty_address', true));
            $from_overseas = ($this->input->post('from_overseas') == 'on') ? 1 : 0;
            $product_table = array(
                'product_name' => cleanit($this->input->post('product_name', true)),
                'brand_name' => cleanit($this->input->post('brand_name', true)),
                'model' => cleanit($this->input->post('model', true)),
                'main_colour' => $this->input->post('main_colour'),
                'product_description' => $description,
                'youtube_id' => cleanit($this->input->post('youtube_id', true)),
                'in_the_box' => $in_the_box,
                'highlights' => $highlights,
                'colour_family' => $colour_family,
                'main_material' => $this->input->post('main_material', true),
                'dimensions' => cleanit($this->input->post('dimensions', true)),
                'weight' => cleanit($this->input->post('weight', true)),
                'product_warranty' => $product_warranty,
                'warranty_type' => $warranty_type,
                'warranty_address' => $warranty_address,
                'certifications' => $certifications,
                'from_overseas' => $from_overseas,
                'product_status' => 'pending'
            );
            //     Product Features Block
            // Since we are getting the specification name; we loop through the specification json
            // SELECT id FROM specifications WHERE spec_name = 'POST_KEY'
            $attributes = array();
            foreach ($_POST as $post => $value) {
                if (substr_compare('attribute_', $post, 0, 10) == 0) {
                    // @TODO: fix the multiple value
                    $feature_name = explode('_', $post);
                    if (is_array($post) && !empty($value)) {
                        $x = json_encode($value);
                        $attributes[$feature_name[1]] = json_encode(json_decode($x));
                    } elseif (!empty($value)) {
                        $attributes[$feature_name[1]] = trim($value);
                    }
                }
            }

            $product_table['attributes'] = json_encode($attributes);
            // update product table
            $this->db->trans_begin();
            $this->seller->update_data(array('id' => $id), $product_table, 'products');
            // Product Variation Block
            $count_check = sizeof($this->input->post('variation_id'));
            // Declare all variables
            $variation = $this->input->post('variation', true);
            $sku = $this->input->post('sku', true);
            $quantity = $this->input->post('quantity', true);
            $sale_price = $this->input->post('sale_price', true);
            $discount_price = $this->input->post('discount_price', true);
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $variation_id = $this->input->post('variation_id');
            if ($count_check > 0) {
                for ($i = 0; $i < $count_check; $i++) {
                    $variation_id['id'] = $variation_id[$i];
                    $variation_data['variation'] = cleanit($variation[$i]);
                    $variation_data['sku'] = cleanit($sku[$i]);
                    $variation_data['quantity'] = cleanit($quantity[$i]);
                    $variation_data['sale_price'] = cleanit($sale_price[$i]);
                    $variation_data['discount_price'] = cleanit($discount_price[$i]);
                    $variation_data['start_date'] = $start_date[$i];
                    $variation_data['end_date'] = $end_date[$i];
                    if ($variation_data['quantity'] < 1) $variation_data['quantity'] = 10;
                    if (empty($variation_data['discount_price'])) {
                        $variation_data['start_date'] = $variation_data['end_date'] = '';
                    }
                    if( $variation['sale_price'] == $variation['discount_price'] ) $variation['discount_price'] = '';
                    if ($variation_id['id'] == 'new') {
                        $variation_data['product_id'] = $id;
                        $this->seller->insert_data('product_variation', $variation_data);
                    } else {
                        $this->seller->update_data(array('id' => $variation_id['id']), $variation_data, 'product_variation');
                    }

                }
            }
            // Product Gallery Block
            if (isset($_FILES) && !empty($_FILES) && count($_FILES)) {
                $counts = sizeof($_FILES['edit_image_file']['tmp_name']);
                $product_gallery = array();
                $files = $_FILES;
                for ($x = 0; $x < $counts; $x++) {
                    $old_name['old_name'] = $files['edit_image_file']['name'][$x];
                    $_FILES['edit_image_file']['name'] = $files['edit_image_file']['name'][$x];
                    $_FILES['edit_image_file']['type'] = $files['edit_image_file']['type'][$x];
                    $_FILES['edit_image_file']['tmp_name'] = $files['edit_image_file']['tmp_name'][$x];
                    $_FILES['edit_image_file']['error'] = $files['edit_image_file']['error'][$x];
                    $_FILES['edit_image_file']['size'] = $files['edit_image_file']['size'][$x];
                    // check if we have the file already uploaded
                    if ($this->curl_get_file_size(PRODUCTS_IMAGE_PATH . $old_name['old_name']) == ''
                        || $this->curl_get_file_size(PRODUCTS_IMAGE_PATH . $old_name['old_name']) == 'unknown') {
                        $product_gallery['featured_image'] = (isset($_POST['featured_image']) && ($old_name['old_name'] == $_POST['featured_image'])) ? 1 : 0;
                        if ($counts == 1) $product_gallery['featured_image'] = 1;
                        // Update
                        $this->seller->update_data(array('image_name' => $old_name['old_name']), $product_gallery, 'product_gallery');
                    } else {
                        if ($_FILES['edit_image_file']['name'] != '') {
                            // we have a new file to upload
                            $image_upload_array = array(
                                'folder' => PRODUCT_IMAGE_FOLDER,
                                'filepath' => $_FILES['edit_image_file']['tmp_name'],
                                'eager' => array("width" => 630, "height" => 570, "crop" => "fill")
                            );
                            $this->cloudinarylib->upload_image($image_upload_array);
                            $image_name = $this->cloudinarylib->get_result();
                            if ($image_name) {
                                $product_gallery = array(
                                    'product_id' => $id,
                                    'seller_id' => $this->session->userdata('logged_id'),
                                    'created_at' => get_now()
                                );
                                $product_gallery['image_name'] = $image_name;
                                if ($counts == 1) $product_gallery['featured_image'] = 1;
                                if (!is_int($this->seller->insert_data('product_gallery', $product_gallery))) {
                                    $image_error++;
                                }
                            } else {
                                $image_error++;
                            }
                        }
                    }
                }// end of for loop
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                // Check for errors
                if ($pricing_error > 0) {
                    $return['message'] = 'Error: There was an error updating one of the pricing variation. Go to "Manage Product > Pricing Variation" to fix it.';
                } elseif ($image_error > 0) {
                    $return['message'] = 'Error: There was an error updating one of the Image. Go to "Manage Product" to fix it.';
                } else {
                    $return['message'] = 'Error: There was an error while updating your product, please contact support if persist.';
                }
            } else {
                $this->db->trans_commit();
                // New product mail to be sent to the seller
                $return['status'] = 'success';
                $return['message'] = 'Success: Your product has been updated, awaiting reviews and approval. You will be notified via email.';
            }
            $this->session->set_flashdata($return['status'] . '_msg', $return['message']);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /*
     * DEPRECATED
     * for local upload
     * */
    function do_upload($file, $id = '')
    {
        $config['upload_path'] = "./data/products/$id/";
        $config['allowed_types'] = 'gif|jpg|png|JPEG|jpeg|bmp';
        $config['max_size'] = 10048;
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;
        $config['overwrite'] = false;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file)) {
            // could append the file name...
            $this->upload->display_errors();
            return false;
        } else {
            return $this->upload->data('file_name');
        }
    }

    /*
     * Upload image via cloudinary
     * */
    function upload_image($filepath, $product_name)
    {
        $this->load->library('cloudinarylib');
        $return = \Cloudinary\Uploader::upload($filepath,
            array("tags" => $product_name,
                "folder" => PRODUCT_IMAGE_FOLDER,
                "public_id" => $product_name,
                "resource_type" => "image",
                "overwrite" => false,
                "eager_async" => true,
                "quality" => 60,
                "eager" => array(
                    array("width" => 630, "height" => 570, "crop" => "fill_pad", 'gravity' => 'auto', 'background' => 'auto')
                )
            )
        );
        return $return;
    }

    /*
     * Load all images for a single product
     * To be used for product edit...*/
    public function load_images($id = '')
    {
        if (!$this->input->is_ajax_request()) redirect(base_url());
        $galleries = $this->seller->get_product_gallery(cleanit($id));
        $result = array();
        foreach ($galleries as $gallery) {
            $img_name = $gallery->image_name;
            $obj['filename'] = $img_name;
            $obj['fileURL'] = PRODUCTS_IMAGE_PATH . $img_name;
            $obj['filesize'] = $this->curl_get_file_size(PRODUCTS_IMAGE_PATH . $img_name);
            $obj['featured'] = $gallery->featured_image;
            $result[] = $obj;
        }
        header('Content-type: text/json');
        header('Content-type: application/json');
        echo json_encode($result);
        exit;
    }

    /*
     * Curl to get file size
     * Used for editing of product
     * */
    function curl_get_file_size($url)
    {
        // Assume failure.
        $result = -1;
        $curl = curl_init($url);
        // Issue a HEAD request and follow any redirects.
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($curl);
        curl_close($curl);
        if ($data) {
            $content_length = "unknown";
            $status = "unknown";
            if (preg_match("/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches)) {
                $status = (int)$matches[1];
            }
            if (preg_match("/Content-Length: (\d+)/", $data, $matches)) {
                $content_length = (int)$matches[1];
            }
            // http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
            if ($status == 200 || ($status > 300 && $status <= 308)) {
                $result = $content_length;
            }
        }
        return $result;
    }


    // Delete product variation row
    //
    public function delete_variation_row(){
        $vid = $this->input->post('vid', true);
        echo $this->seller->delete( array('id' => $vid ), 'product_variation');
        exit;
    }

    /*
     * Upload  description image
     * */
    function description_image_upload()
    {
        if (!$this->input->is_ajax_request()) redirect(base_url());
        if ($_FILES) {
            $allowed = array('png', 'jpg', 'jpeg', 'gif');
            $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            if (!in_array(strtolower($extension), $allowed)) {
                echo '{"status" : "error"}';
                exit;
            }
            $data = array(
                'folder' => PRODUCT_DESCRIPTION_FOLDER,
                'filepath' => $_FILES['file']['tmp_name'],
                'eager' => array("width" => 400, "height" => 400, "crop" => "fill")
            );
            $this->cloudinarylib->upload_image($data);
            echo $this->cloudinarylib->get_result('full_url');
            exit;
        }
    }

    /*
     * Delete description image
     * */
    function decription_image_remove()
    {
        if (!$this->input->is_ajax_request()) redirect(base_url());
        $src = $this->input->post('src');
        // lets build the public id
        $explode = explode('/', $src);
        $image_name = explode('.', end($explode));
        $public_id = PRODUCT_DESCRIPTION_FOLDER . $image_name[0];
        echo $this->cloudinarylib->delete_image($public_id);
        exit;
    }

    // Delete product and also remove from cloudinary
    function product_image_remove()
    {
        if (!$this->input->is_ajax_request()) redirect(base_url());
        $image_name = $this->input->post('image_name');
        $explode = explode('.', $image_name);
        $public_id = PRODUCT_IMAGE_FOLDER . $explode[0];
        // delete from DB
        if ($this->seller->delete(array('image_name' => $image_name), 'product_gallery')) {
            echo $this->cloudinarylib->delete_image($public_id);
            exit;
        }
    }
}