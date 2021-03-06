<?php

Class Seller_model extends CI_Model
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

    // Login Customer
    function login($data = array(), $table_name = 'users')
    {
        if (!empty($data)) {
            $this->db->where('email', $data['email']);
            if ($this->db->get($table_name)->row()) {
                $this->db->where('email', $data['email']);
                $salt = $this->db->get($table_name)->row()->salt;
                if ($salt) {
                    $password = shaPassword($data['password'], $salt);
                    $this->db->where('email', cleanit($data['email']));
                    $this->db->where('password', $password);
                    $result = $this->db->get('users');
                    if ($result->num_rows() == 1) {
                        $c_update = array('last_login' => get_now(), 'ip' => $_SERVER['REMOTE_ADDR']);
                        $this->db->where('email', $data['email']);
                        $this->db->update($table_name, $c_update);
                        return $result->row();
                    }
                }
            }
        }
        return false;
    }

    // Create An Account for user

    function create_account($data = array(), $table_name = 'users')
    {
        $result = '';
        if (!empty($data)) {
            try {
                $this->db->insert($table_name, $data);
                $result = $this->db->insert_id();
            } catch (Exception $e) {
                $result = $e->getMessage();
            }
        }
        return $result;
    }

    // Update table
    function update_data($access, $data = array(), $table_name = 'sellers')
    {
        try {
            $this->db->where($access);
            $result = $this->db->update($table_name, $data);
        } catch (Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }

    function delete_data($id, $table)
    {
        $this->db->where('id', $id);
        return $this->db->delete($table);
    }

    function delete( $access, $table ){
        $this->db->where($access);
        return $this->db->delete( $table );
    }

    // check if the password is correct

    function cur_pass_match($password = null, $access = '', $table = 'users')
    {
        if ($password) {
            $this->db->where('id', $access);
            $this->db->or_where('email', $access);
            $salt = $this->db->get('users')->row()->salt;
            $this->db->where('id', $access);
            $this->db->or_where('email', $access);
            $curpassword = $this->db->get($table)->row()->password;
            $password = shaPassword($password, $salt);
            if ($password === $curpassword) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Change Password 
    function change_password($password, $access = '', $table = 'users')
    {
        if ($access == '') $access = $this->session->userdata('logged_id');
        $salt = salt(50);
        $password = shaPassword($password, $salt);
        $data = array(
            'password' => $password,
            'salt' => $salt
        );
        $this->db->where('id', $access);
        return $this->db->update($table, $data);
    }

    /**
     * @param $access : id
     * @param $details : string of data you only want to retrieve
     * @return mixed
     */
    function get_profile_details($access, $details = "*")
    {
        $this->db->select($details);
        $this->db->where('id', $access);
        return $this->db->get('users')->row();
    }

    /**
     * @param $access : id
     * @param $details : Get all login user  profile details
     * @return mixed
     */
    function get_profile($access)
    {
        $query = "SELECT * FROM users u 
                LEFT JOIN sellers s ON (u.id = s.uid)
                WHERE u.id = $access";
        return $this->db->query($query)->row();
    }

    /**
     * @param $access : id
     * @param $details : Get all login user  profile details
     * @return mixed
     */
    function get_seller_status($access)
    {
        $this->db->select("is_seller,first_name,last_name");
        $this->db->where('id', $access);
        return $this->db->get('users')->row();
    }

    function get_product($id, $status = '')
    {
        switch ($status) {
            case 'pending':
                $query = "SELECT p.product_name, p.id,p.sku,p.created_on,p.product_status,AVG(v.sale_price) AS sale_price, AVG(v.discount_price) AS discount_price FROM
                products AS p JOIN product_variation AS v ON v.product_id = p.id WHERE p.seller_id = ? AND p.product_status = ? GROUP BY p.id ORDER BY p.id DESC ";
                return $this->db->query($query, array($id, $status))->result_array();
            case 'draft':
                $query = "SELECT p.product_status, p.product_name, p.id,p.sku,p.created_on,p.product_status,AVG(v.sale_price) AS sale_price, AVG(v.discount_price) AS discount_price FROM
                products AS p LEFT JOIN product_variation AS v ON v.product_id = p.id
                WHERE (NOT EXISTS (select 1 from product_gallery g where p.id = g.product_id ) OR EXISTS (select 1 from product_gallery g where p.id = g.product_id ) )
                AND (NOT EXISTS (select 1 from product_variation vi where p.id = vi.product_id ) OR EXISTS (select 1 from product_variation vi where p.id = vi.product_id ) )
                AND p.seller_id = ? AND p.product_status = ?
                GROUP BY p.id ORDER BY p.id DESC ";
//                $query = "SELECT * FROM products WHERE seller_id = ? AND product_status = ?";
                return $this->db->query($query, array($id, $status))->result_array();
            case 'suspended':
                $query = "SELECT * FROM (SELECT p.product_name, p.id,p.sku,p.created_on,p.product_status,AVG(v.sale_price) AS sale_price, AVG(v.discount_price) AS discount_price FROM
                products AS p  INNER JOIN product_variation AS v ON v.product_id = p.id WHERE p.seller_id = ? AND p.product_status = ? GROUP BY p.id ORDER BY p.id DESC) t WHERE t.product_name IS NOT NULL";
                return $this->db->query($query, array($id, $status))->result_array();
                break;
            case 'missing_images':
                $query = "SELECT p.product_name, p.id,p.sku,p.created_on,p.product_status,AVG(v.sale_price) AS sale_price, AVG(v.discount_price) AS discount_price FROM
                products AS p JOIN product_variation AS v ON (v.product_id = p.id) WHERE NOT EXISTS (select 1 from product_gallery g where p.id = g.product_id ) AND p.seller_id = ? ORDER BY p.id DESC";
                return $this->db->query($query, array($id))->result_array();
                break;
            case 'out_of_stock':
                $query = "SELECT * FROM (SELECT p.product_name, p.id,p.sku,p.created_on,p.product_status,AVG(v.sale_price) AS sale_price, AVG(v.discount_price) AS discount_price FROM
                products AS p 
                JOIN product_variation AS v ON (v.product_id = p.id)
                WHERE EXISTS (select 1 from product_variation pv where p.id = pv.product_id AND pv.quantity = 0 ) AND p.seller_id = ? ORDER BY p.id DESC) t WHERE t.product_name IS NOT NULL";
                return $this->db->query($query, array($id))->result_array();
                break;
            default:
                $query = "SELECT p.product_name, p.id,p.sku,p.created_on,p.product_status,AVG(v.sale_price) AS sale_price, AVG(v.discount_price) AS discount_price FROM
                products AS p INNER JOIN product_variation AS v ON v.product_id = p.id WHERE p.seller_id = ? GROUP BY p.id ORDER BY p.id DESC";
                return $this->db->query($query, array($id))->result_array();

        }


        $query = "SELECT p.product_name, p.id, p.sku, p.created_on, p.product_status, AVG(v.sale_price) AS sale_price, AVG(v.discount_price) AS discount_price 
        FROM products AS p JOIN product_variation AS v ON v.product_id = p.id  ";
        if ($status !== '' AND $status !== 'missing_images') {
            $query .= " AND p.product_status = '$status'";
        } elseif ($status == 'missing_images') {
            $query .= "INNER JOIN product_gallery AS g";
        }
        $query .= " WHERE p.seller_id = $id GROUP BY p.id ORDER BY p.id DESC";
        $output = $this->db->query($query)->result_array();
        return $output;
    }

    /*
     * Get single product detail
     * */
    function get_single_product_detail($sid, $pid)
    {
        $query = "SELECT p.*, g.image_name, o.amount, o.quantity_sold, v.variation_qty, g.image_name FROM products AS p
                    LEFT JOIN (SELECT ga.image_name, ga.product_id FROM product_gallery ga WHERE ga.featured_image = 1 AND ga.product_id = {$pid} ) g 
                    ON (p.id = g.product_id )
                    LEFT JOIN (SELECT SUM(ord.amount) as amount, ord.product_id, SUM(ord.qty) quantity_sold FROM orders AS ord WHERE (ord.payment_made = 'success' OR ord.active_status ='completed') GROUP BY ord.product_id ) AS o
                    ON ( o.product_id = p.id)
                    LEFT JOIN (SELECT SUM(var.quantity) AS variation_qty, var.product_id FROM product_variation var GROUP BY var.product_id ) v
                    ON ( v.product_id = p.id)
                    WHERE p.id = {$pid} AND p.seller_id = {$sid} GROUP BY p.id ";
        return $this->db->query($query)->row();
    }

    /**
     * @param $id
     * @param $label
     * @return DB_result_array
     */

    function get_category_children($pid)
    {
        $this->db->select('id, name');
        $this->db->where('pid', $pid);
        return $this->db->get('categories')->result();
    }

    // Function to confirm if the category has a child
    function has_child($id)
    {
        $this->db->where('pid', $id);
        if ($this->db->get('categories')->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *Function to get the parent category of a particular category
    *Called the parent_recurssive
    */

    function get_parent_details($id)
    {
        $array = $this->parent_slug_top($id);
        return $this->db->query("SELECT name, slug, description, specifications FROM categories WHERE id IN ('" . implode("','", $array) . "')")->result();
    }

    /*
        Return an object (name, slug, description, specifications) of all the parent of a category
    */

    function parent_slug_top($id)
    {
        // Select category
        $GLOBALS['array_variable'] = array();
        $select_category = "SELECT id, slug FROM categories WHERE id = {$id}";
        $result = $this->db->query($select_category);
        if ($result->num_rows() >= 1) {
            $pid = $result->row()->id;
            $this->parent_recurssive($pid);
            $array = array_filter($GLOBALS['array_variable']);
            $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
            $new_array = array();
            foreach ($it as $v) {
                array_push($new_array, $v);
            }
            array_push($new_array, $id); // Lets push its own ID also
            return $new_array;
        } else {
            return $GLOBALS['array_variable'];
        }

    }


    /*
    *Called by the parent_slug top, helps to generate the parent id
    */

    function parent_recurssive($pid)
    {
        $category_pid = $pid;
        $total_categories = $this->db->get('categories')->result_array();
        $count = count($total_categories);

        $data = array();
        for ($i = 0; $i < $count; $i++) {
            if ($total_categories[$i]['id'] == $category_pid) {
                array_push($data, $total_categories[$i]['pid']);
            }
        }
        array_push($GLOBALS['array_variable'], $data);
        foreach ($data as $key => $value) {
            $this->parent_recurssive($value);
        }
    }


    // Get a slpecific category id by its slug
    function category_id($slug)
    {
        $query = "SELECT id FROM categories WHERE slug = ? OR name = ?";
        return $this->db->query($query, array($slug, $slug));
    }


    /**
     * @param $table
     * @return string
     */
    function generate_code($table = 'products')
    {
        do {
            $number = random_string('nozero', 6);
            $this->db->where('sku = ', $number);
            $this->db->from($table);
            $count = $this->db->count_all_results();
        } while ($count >= 1);
        return $number;
    }


    function generate_code_for_image($table = 'product_gallery')
    {
        do {
            $number = random_string('nozero', 12);
            $this->db->where('image_name = ', $number);
            $this->db->from($table);
            $count = $this->db->count_all_results();
        } while ($count >= 1);
        return $number;
    }

    function generate_general_code($table = 'users', $label)
    {
        do {
            $number = generate_token(40);
            $this->db->where($label, $number);
            $this->db->from($table);
            $count = $this->db->count_all_results();
        } while ($count >= 1);
        return $number;
    }

    /**
     * Confirm if the person accessing thr product is the owner
     * @param $user_id |product_id
     * @return num_rows
     */

    function is_product_owner($uid = '', $pid = "")
    {
        $this->db->where('seller_id', $uid);
        $this->db->where('id', $pid);
        return $this->db->get('products')->num_rows();
    }

    /**
     * @param $name - productsubcategory
     * @return CI_DB_result_array
     */

    function get_specifications($spec_id)
    {

        $this->db->select('spec_name,options,multiple_options,description');
        $this->db->where('id', $spec_id);
        $result = $this->db->get('specifications')->row();
        return $result;
    }


    /**
     * @param $oroduct_id
     * @return CI_DB_result_array
     */

    function get_product_gallery($id)
    {
        $this->db->select('image_name,featured_image');
        $this->db->where('product_id', $id);
        return $this->db->get('product_gallery')->result();
    }

    /**
     * @param $productid
     * @return CI_DB_result_array
     */
    function get_orders($id = '', $status = '', $array = array())
    {
        $query = "SELECT p.product_name,p.id pid,v.variation, p.created_on created_on, o.order_date, o.commission commission, o.id orid, g.image_name,o.qty,o.amount, o.status, o.active_status
                FROM products p 
                LEFT JOIN orders o ON (p.id = o.product_id)
                LEFT JOIN product_gallery g ON (g.product_id = p.id AND g.featured_image = 1)
                LEFT JOIN product_variation v ON (v.product_id = p.id)
                WHERE o.seller_id = $id";
        if ($status != '') {
            $query .= " AND ( o.active_status = '{$status}' OR o.payment_made = '{$status}')";
        }
//        $query .= " GROUP BY o.order_code ";
        $limit = $array['is_limit'];
        if ($limit == true) {
            $query .= " LIMIT " . $array['offset'] . "," . $array['limit'];
        }
//        die( $query );
        return $this->db->query($query)->result();
    }


    /**
     * @param $sid
     * @return CI_DB_int
     */

    function get_unread_message($sid)
    {
        $query = "SELECT COUNT(*) FROM sellers_notification_message WHERE seller_id = {$sid} AND is_read = 0";
        return $this->db->query( $query );
    }

    function get_message($sid = '', $type = 'all', $id = '')
    {
        if ($type == 'all') {
            $this->db->where('seller_id', $sid);
            $this->db->order_by('created_on', 'DESC');
            return $this->db->get(TABLE_SELLER_NOTIFICATION_MESSAGE);
        } else {
            $this->db->where('seller_id', $sid);
            $this->db->where('id', $id);
            if ($this->db->update(TABLE_SELLER_NOTIFICATION_MESSAGE, array('is_read' => 1))) {
                $this->db->select('title,content,created_on');
                $this->db->where('seller_id', $sid);
                $this->db->where('id', $id);
                return $this->db->get(TABLE_SELLER_NOTIFICATION_MESSAGE)->row_array();
            }
        }
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

    function set_field($table, $field, $set, $where)
    {
        $this->db->where($where);
        $this->db->set($field, $set, false);
        return $this->db->update($table);
    }

    // Set a field by its label

    function incoming_balance($id)
    {
        $query = "SELECT ( (SUM(amount) * SUM(qty)) - SUM(commission)) incoming_bal FROM orders WHERE ( seller_id = {$id} AND (active_status = 'shipped' OR active_status = 'delivered' OR active_status = 'completed') AND seller_wallet = 0 AND order_date <= SUBDATE(NOW(), INTERVAL 7 DAY) )";
        return $this->run_sql($query)->row();
    }


    /*
     * Incoming Balance: SUM of Item Sold - Commision on each Item at the status of shipped or active_status = 'delivered or active_status = 'completed'
     * That the seller has not received to his wallet
     * From the orders_table
     * */

    /**
     * Run a general SQL
     * @param $query
     * @return mixed
     */
    function run_sql($query)
    {
        return $this->db->query($query);
    }

    /*
     * Incoming_order_code :
     * The order code of the above query
     * */

    function incoming_order_code($id)
    {
        $query = "SELECT order_code FROM orders WHERE (seller_id = {$id} AND (active_status = 'shipped' OR active_status = 'delivered' OR active_status = 'completed') AND seller_wallet = 0 AND order_date <= SUBDATE(NOW(), INTERVAL 7 DAY) )";
        return $this->run_sql($query)->result();
    }

    /*
     * Get the last 7 days commission on products sold
     * And has not been received by the seller
     * */
    function last_7_days_commission($id)
    {
        $query = "SELECT SUM(commission) as commission FROM orders WHERE ( seller_id = {$id} AND (active_status = 'shipped' OR active_status = 'delivered' OR active_status = 'completed') AND seller_wallet = 0 AND order_date <= SUBDATE(NOW(), INTERVAL 7 DAY) ) ";
        return $this->run_sql($query)->row();
    }

    /*
     * Get all commission, products relating to the order code
     * */
    function incoming_order_code_detail($order_code)
    {
        $id = $this->session->userdata('logged_id');
        $query = $this->run_sql("SELECT qty,amount,product_id FROM orders WHERE seller_id = {$id} AND order_code = {$order_code}")->result_array();
        if ($query) {
            $result = array();
            foreach ($query as $q) {
                $res['amount'] = $q['amount'];
                $res['qty'] = $q['qty'];
                // make a query for the product
                $pquery = $this->run_sql("SELECT p.product_name, c.commission, c.name FROM products p JOIN categories c ON (p.category_id = c.id) WHERE p.id = {$q['product_id']}")->row_array();
                $res['category'] = $pquery['name'];
                $res['product'] = anchor(base_url('manage/stat/' . $q['product_id']), character_limiter($pquery['product_name'], 10), 'class="btn-link"');
                $res['commission'] = $pquery['commission'];
                $res['fee'] = (($pquery['commission'] / 100) * ($q['amount'] * $q['qty']));
                array_push($result, $res);
            }
            return $result;
        }
        return array();
    }

    /*
     * Due and unpaid money
     * Get the sum of amount multiplied by the total quantity subtract onitshamarket commission
     * From a seller and the active_status = 'completed' and has passed 7 days delivery
     * */
    function due_unpaid($id)
    {
        $query = "SELECT  (SUM(amount) * SUM(qty) - SUM(commission) ) due FROM orders 
        WHERE (seller_id = {$id} AND active_status = 'completed' AND  order_date <= SUBDATE(NOW(), INTERVAL 7 DAY) ) ";
        return $this->run_sql($query)->row();
    }

    /*
     * Total money paid to the seller for the last 3 months
     * */
    function last_3_month_paid($id)
    {
        $query = "SELECT SUM(amount) as amount FROM payouts WHERE (user_id = {$id} AND status = 'completed')";
        return $this->run_sql($query)->row();
    }
    /*
     * Get top 20 sales for a seller*/
    function top_20_sales($uid){
        $query = "SELECT p.product_name, p.id, SUM(o.qty) no_of_sales FROM orders o 
        LEFT JOIN products p ON (p.id = o.product_id) 
        WHERE o.seller_id = {$uid} AND payment_made = 'success' GROUP BY o.product_id ORDER BY o.qty LIMIT 0, 20";
        return $this->run_sql($query)->result();
    }

    /* Get order count*/
    function order_chart($uid)
    {
        $query = "SELECT
                SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
                SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
                SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
                SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
                SUM(IF(month = 'May', total, 0)) AS 'May',
                SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
                SUM(IF(month = 'Jul', total, 0)) AS 'Jul',
                SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
                SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
                SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
                SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
                SUM(IF(month = 'Dec', total, 0)) AS 'Dec',
                SUM(total) AS total_yearly
                FROM (
            SELECT DATE_FORMAT(order_date, '%b') AS month, SUM(qty) as total
            FROM orders
            WHERE order_date <= NOW() and order_date >= Date_add(Now(),interval - 12 month)
            AND seller_id = {$uid} AND payment_made = 'success'
            GROUP BY DATE_FORMAT(order_date, '%m-%Y')) as sub";
        return $this->run_sql($query)->row_array();
    }

    /*
     * Get Single Seller Questions
     */

    function get_questions($sid = '')
    {
        if (!empty($sid)) {
            $query = "SELECT q.id, q.question, q.qtimestamp,q.display_name, p.id pid, p.product_name, p.product_description, s.legal_company_name FROM qna q 
          LEFT JOIN products p ON (p.id = q.pid)
          LEFT JOIN sellers s ON (s.uid = p.seller_id)  
          WHERE (s.uid = '$sid' AND q.answer = '' AND q.status = 'approved')";

            return $this->run_sql($query)->result();
        }
    }
    function answer_question($qid, $answer){
        $timestamp = get_now();
        $data = array(
            'atimestamp' => $timestamp,
            'answer' => $answer
        );
        return $this->update_data( array('id' => $qid), $data, 'qna');
    }

    /*
     * Load sales data graph
     * */
    function load_sales_data( $type = 'daily' ){
        $id = $this->session->userdata('logged_id');
        switch ($type) {
            case 'weekly':
                $select = "SELECT DATE_FORMAT(order_date, '%X-%V') as date,
                SUM(qty) AS q FROM orders WHERE seller_id = {$id} AND payment_made = 'success'
                AND order_date BETWEEN DATE_SUB(CURDATE(),INTERVAL 3 MONTH ) AND DATE_SUB(CURDATE() ,INTERVAL 0 MONTH)
                GROUP BY date 
                ORDER BY date";
                return $this->db->query( $select )->result_array();
                break;
            case 'monthly':
                $select = "SELECT DATE_FORMAT(order_date, '%Y-%m') as date,
                SUM(qty) AS q FROM orders WHERE seller_id = {$id} AND payment_made = 'success'
                GROUP BY date 
                ORDER BY date LIMIT 12";
                return $this->db->query( $select )->result_array();
                break;
            case 'yearly':
                $select = "SELECT DATE_FORMAT(order_date, '%Y') as date, SUM(qty) AS q FROM orders
                WHERE seller_id = {$id}  AND payment_made = 'success'
                GROUP BY date ORDER BY date ";
                return $this->db->query( $select )->result_array();
                break;
            default:
                $select = "SELECT DATE(order_date) as date, SUM(qty) AS q FROM orders
                WHERE seller_id = {$id} AND active_status = 'completed'
                GROUP BY date ORDER BY date LIMIT 30 ";
                return $this->db->query( $select )->result_array();
                break;
        }
    }

}
