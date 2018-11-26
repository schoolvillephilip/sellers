<?php

Class User_model extends CI_Model{


    /**
     * @param string $id
     * @param string $table
     * @return mixed
     */
    function get_profile($id ='' , $table = 'users'){
        $this->db->where('id', $id );
        $this->db->or_where('email', $id);
        return $this->db->get($table)->row();
    }


    /**
     * @param array $data
     * @param string $table_name
     * @return bool|mixed
     */
    function login($data = array(), $table_name = 'users'){
		if(!empty($data)) {
            $email = cleanit($data['email']);
            $this->db->where('email', $data['email']);
            if ($this->db->get($table_name)->row()){
                $this->db->where('email',$data['email']);
                $salt = $this->db->get($table_name)->row()->salt;
                if ($salt) {
                    $password = shaPassword($data['password'], $salt);
                    $this->db->where('email', $data['email']);
                    $this->db->where('password', $password);
                    $result = $this->db->get('users');
                    if ($result->num_rows() == 1) {
                    	$c_update = array('last_login' => get_now(), 'ip' => $_SERVER['REMOTE_ADDR'] );
                    	$this->db->where('email', $data['email']);
                    	$this->db->update($table_name, $c_update);
                        return $result->row();
                    } else {
                        return false;
                    }
                }
            }
        }
	}


    /**
     * @param array $data
     * @param string $table_name
     * @return int|string
     */
    function create_account($data = array(), $table_name = 'users'){
		$result = '';
		if(!empty($data)){
			try {
				$this->db->insert($table_name, $data);
				$result = $this->db->insert_id();
			} catch (Exception $e) {
				$result = $e->getMessage();
			}
			return $result;
		}
	}


    /**
     * @param string $access
     * @param array $data
     * @param string $table_name
     * @return bool
     */
    function update_data($access = '' , $data = array(), $table_name = 'users'){
        $this->db->where('id', $access);
        return $this->db->update( $table_name, $data );
    }


    /**
     * @param string $where
     * @param $bid
     * @return bool
     */
    function update_billing_address($where = '', $bid){
        $this->db->where($where);
        $this->db->set('primary_address', 0, false);
        if($this->db->update('billing_address')){
            $this->db->where('id', $bid);
            $this->db->update('billing_address', array('primary_address' => 1));
            $select = "SELECT a.price FROM area a LEFT JOIN billing_address b ON(b.aid = a.id) WHERE b.id = $bid";
            return $this->db->query($select)->row();
        }
        return false;
    }

    /**
     * @param null $password
     * @param string $access
     * @param string $table
     * @return bool
     */
    function cur_pass_match($password = null, $access = '', $table = 'users'){
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


    /**
     * @param $password
     * @param string $access
     * @param string $table
     * @return bool
     */
    function change_password($password, $access = '', $table = 'users'){
        if($access == '') $access = $this->session->userdata('logged_id');
        $salt = salt(50);
        $password = shaPassword($password, $salt);
        $data = array(
            'password' => $password,
            'salt' => $salt
        );
        $this->db->where('id',  $access);
        $this->db->or_where('email',$access);
        return $this->db->update($table, $data);
    }


    /**
     * @param $uid
     * @param $pid
     * @param $action
     * @param string $table_name
     * @param string $fid
     * @return bool|mixed|string
     */
    function favourite($uid, $pid, $action, $table_name = 'favourite', $fid='' ){
        if( $action == 'save'){
            try {
                if( $this->db->insert($table_name, array('uid' => $uid, 'product_id' => $pid))) 
                    return true;
            } catch (Exception $e) {
                $result = $e->getMessage();
            }
            return $result;
        }elseif( $action == 'unsave'){
            $this->db->where('product_id', $pid);
            $this->db->where('uid', $uid);
            return $this->db->delete($table_name);
        }else{
            $this->db->where('id', $fid);
            return $this->db->delete($table_name);
        }
    }


    /**
     * @param $id
     * @return mixed
     */
    function get_saved_items($id ){
        $query = $this->db->query("SELECT p.id, p.product_name, p.product_status, v.discount_price, v.sale_price,v.quantity, g.image_name, f.id as fav_id, f.date_saved
            FROM products p
            JOIN (SELECT variation.sale_price AS sale_price, variation.discount_price AS discount_price, variation.product_id , SUM(variation.quantity) AS quantity FROM product_variation variation GROUP BY variation.product_id) AS v ON( v.product_id = p.id)
            JOIN product_gallery AS g ON ( p.id = g.product_id AND g.featured_image = 1 )
            JOIN favourite AS f ON (f.product_id = p.id )
            WHERE f.uid = $id GROUP BY p.id ORDER BY f.date_saved")->result();
        return $query; 
    }

    /**
     * @param $id
     * @return mixed
     */
    function get_my_orders($id ){
        $query = $this->db->query("SELECT p.id as pid, p.name, g.image_name, o.order_date, o.order_code, o.status
        FROM orders o
        JOIN (SELECT prod.id AS id, prod.product_name AS name FROM products AS prod) AS p ON (p.id = o.product_id)
        JOIN product_gallery AS g ON (o.product_id = g.product_id AND g.featured_image = 1 )
        WHERE buyer_id = $id ORDER BY o.id DESC LIMIT 10")->result();
        return $query; 
    }

    // Get states
    function get_states(){
        return $this->db->get('states')->result_array();
    }

    // Get the user area
    function get_area( $sid = ''){
        $this->db->select('id,name,price');
        $this->db->where('sid', $sid);
        return $this->db->get('area')->result_array();
    }

    /**
     * @param string $table_name
     * @param $where
     * @return mixed
     */
    function get_rows($table_name ='users', $where ){
        $this->db->where($where);
        return $this->db->get( $table_name )->row();
    }

    function recover_email(){}

    /*
    * @param id = user id
    * @return CI_result
    */
    function get_user_billing_address( $id ){
        return $this->db->query("SELECT b.*, s.name, a.name FROM billing_address b LEFT JOIN states s ON (s.id = b.sid) LEFT JOIN area a ON (a.id = b.aid) WHERE b.uid = $id")->result();
    }

    function is_address_set( $id ){
        $this->db->where('uid', $id);
        $this->db->where('primary_address', 1);
        if( $this->db->get('billing_address')->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param string $uid
     * @param $address_id
     * @return array
     */
    function get_single_address($uid = '', $address_id){
        if( $uid != '' ) $this->db->where('uid', $uid);
        $this->db->where('id', $address_id);
        return $this->db->get('billing_address')->result_array();
    }

    function get_pickup_address(){
        $this->db->where('enable', 1);
        return $this->db->get('pickup_address')->result();
    }


    /**
     * @param $id
     * @return string
     */
    function get_default_address_price($id){
		$select = "SELECT a.price price FROM billing_address b INNER JOIN area a ON(a.id = b.aid) WHERE b.primary_address = 1 AND b.uid = $id";
        if( $this->db->query($select )->num_rows()){
            return $this->db->query( $select )->row()->price;
        }else{
            return '';
        }
	}


    
}
