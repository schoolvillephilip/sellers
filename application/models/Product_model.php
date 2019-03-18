<?php

Class Product_model extends CI_Model
{

    // Insert data
    function insert_data($table = 'users', $data = array())
    {
        try {
            $this->db->insert($table, $data);
            $result = $this->db->insert_id();
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }

    // Update table
    function update_data($access = '', $data = array(), $table_name = 'users')
    {
        $this->db->where('id', $access);
        $this->db->or_where('email', $access);
        return $this->db->update($table_name, $data);
    }

    // Update table
    function product_update_data($access = '', $data = array(), $table_name = 'products')
    {
        $this->db->where('id', $access);
        return $this->db->update($table_name, $data);
    }

    // Get single product
    function get_product($id = '')
    {
        return $this->db->query('SELECT p.*, u.first_name, u.last_name FROM products AS p LEFT JOIN users AS u ON (p.seller_id = u.id) WHERE p.id = ? ', $id)->row();
    }

    // Get featured_image
    function get_featured_image($id = '')
    {
        $this->db->select('image_name');
        $this->db->where('product_id', $id);
        $this->db->where('featured_image', 1);
        return $this->db->get('product_gallery')->row();
    }

    // To get the respective categories or sub
    // Function used for the category page
    function get_categories($str = '')
    {
        // Get all the i
        $array = $this->slug($str);
        $query = $this->db->query("SELECT name FROM categories WHERE id IN ('" . implode("','", $array) . "') LIMIT 10 ");
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            // Select all categories then
            $query = $this->db->query("SELECT name FROM categories LIMIT 10");
            return $query->result();
        }
    }

    // Get single variation

    function slug($slug): array
    {
        $GLOBALS['array_var'] = array();

        $select_category = "SELECT id FROM categories WHERE slug = ? ";
        $query = $this->db->query($select_category, array($slug));

        if ($query->num_rows() >= 1) {
            $id = $query->row()->id;
            $this->recurssive($id);
            $array = array_filter($GLOBALS['array_var']);
            $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
            $new_array = array();
            foreach ($it as $v) {
                array_push($new_array, $v);
            }
            array_push($new_array, $id); // Lets push its own ID also
            return $new_array;
        } else {
            return $GLOBALS['array_var'];
        }
    }

    // Single product, get all the product variation

    function recurssive($id)
    {
        $category_id = $id;
        $total_categories = $this->db->get('categories')->result_array();
        $count = count($total_categories);

        $data = array();
        for ($i = 0; $i < $count; $i++) {
            if ($total_categories[$i]['pid'] == $category_id) {
                array_push($data, $total_categories[$i]['id']);
            }
        }
        array_push($GLOBALS['array_var'], $data);
        foreach ($data as $key => $value) {
            $this->recurssive($value);
        }
    }

    // Check if the single product has variation

    function get_variation($id = '')
    {
        return $this->db->query('SELECT * FROM product_variation WHERE product_id = ? AND quantity > 0 ORDER BY id LIMIT 1', $id)->row();
    }

    // Get all product Images

    function get_variations($id = '')
    {
        return $this->db->query('SELECT * FROM product_variation WHERE product_id = ? ', $id)->result_array();
    }

    // Get user has favourite this property

    function check_variation($id)
    {
        $this->db->select('quantity,sale_price,discount_price');
        $this->db->where('id', $id);
        $this->db->limit(1);
        return $this->db->get('product_variation')->result_array();
    }

    /*
    *This function is to call the recurssive function and
    *return the children id
    */

    function get_gallery($id)
    {
        $this->db->where('product_id', $id);
        $this->db->select('*');
        $this->db->from('product_gallery');
        $this->db->group_by('product_id');
        return $this->db->get();
    }


    /*
    *Function to get the parent category of a particular category
    *Called the parent_recurssive
    */

    function single_category_detail($id)
    {
        $this->db->select('description, name, title, slug');
        $this->db->where('id', $id);
        return $this->db->get('categories')->row();
    }

    /*
    *Called by the parent_slug top, helps to generate the parent id
    */

    function category_details($str = '', $search_like = '')
    {
        $result = '';
        if ($str != '') {
            if ($this->check_slug_availability($str)) {
                $select = "SELECT description, name, title FROM categories WHERE slug = '{$str}' LIMIT 1";
                $result = $this->db->query($select)->row();
                return $result;
            }
        } else {
            // That means its coming from search
            $query = "SELECT c.description,c.name,c.title, p.id FROM products p LEFT JOIN categories c ON (c.id = p.category_id) WHERE p.product_name LIKE '%{$search_like}%' LIMIT 1";
            return $this->db->query($query)->row();
        }
    }

    // Return CI_row

    /**
     * Generic function
     * @param $table
     * @return string
     */
    function generate_code($table = 'orders', $field = 'order_code')
    {
        do {
            $number = random_string('nozero', 8);
            $this->db->where($field, $number);
            $this->db->from($table);
            $count = $this->db->count_all_results();
        } while ($count >= 1);
        return $number;
    }

    function set_field($table, $field, $set, $where)
    {
        $this->db->where($where);
        $this->db->set($field, $set, false);
        $this->db->update($table);
    }

    // check if user has bought a product

    function num_rows_count($table_name, $where)
    {
        $this->db->where($where);
        if ($this->db->get($table_name)->num_rows()) {
            $this->db->where($where);
            return $this->db->get($table_name)->row()->id;
        } else {
            return false;
        }
    }

    // check nom rows and return the id if found

    function get_rating_review($table, $select, $uid, $pid)
    {
        $this->db->select($select);
        $this->db->where('product_id', $pid);
        $this->db->where('user_id', $uid);
        return $this->db->get($table)->row();
    }

    // Select on rating || review

    function get_reviews($id = '')
    {
        $select = "SELECT review.*, rating.rating_score FROM product_review review LEFT JOIN product_rating rating ON (rating.product_id = review.product_id AND rating.user_id = review.user_id) WHERE review.product_id = $id";
        return $this->db->query($select)->result_array();
    }

    //  Quick view query
    function get_quick_view_details($id)
    {
        $select = "SELECT product_description,seller_id FROM products WHERE id = $id";
        return $this->db->query($select)->row();
    }


    // Get a row of a paticular table
    // Return CI_row
    function get_row($table_name, $select = '', $condition = '')
    {
        if ($select != '') {
            $this->db->select($select);
        }
        if (!empty($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get($table_name)->row();
    }

    /**
     * @param $table_name
     * @param array $condition
     * @return array
     */
    function get_results($table_name = '', $select = '', $condition = '')
    {
        if ($select != '') {
            $this->db->select($select);
        }
        if (!empty($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get($table_name)->result();
    }

    /**
     * @param $address_id
     * @return mixed
     */
    function get_billing_amount($address_id)
    {
        $select = "SELECT b.aid, a.price FROM billing_address b LEFT JOIN area a ON (b.aid = a.id ) WHERE b.id = {$address_id}";
        return $this->db->query($select)->row()->price;
    }

}
