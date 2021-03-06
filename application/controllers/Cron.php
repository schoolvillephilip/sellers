<?php
class Cron extends CI_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        redirect("https://www.onitshamarket.com");
    }

    /*
     * Send money to seller account when its 7 days above and order has been marked completed
     * */
    public function inburse_seller(){
        /*
         * Run a query to pass seller money to
         * */
        $query = "SELECT o.id, o.amount, o.qty, o.commission,o.seller_id, s.balance FROM orders o 
        JOIN sellers s ON (s.uid = o.seller_id)
        WHERE o.payment_made = 'success' AND o.seller_wallet = 0 AND o.order_date <= SUBDATE(NOW(), INTERVAL 7 DAY)";
        $results = $this->db->query( $query)->result();
        $x = 0;
        if( $results && INBURSE_SELLER){
            foreach( $results as $result ){
                $real_amount = ( $result->amount * $result->qty );
                $earned = $real_amount - $result->commission;
                $earned += $result->balance;
                try {
                    $this->seller->update_data(array('uid' => $result->seller_id), array('balance' => $earned));
                    //update the order table
                    $this->seller->update_data(array('id' => $result->id), array('seller_wallet' => 1), 'orders');
                    $x++;
                    // We can send the seller email that money don enter
                } catch (Exception $e) {

                }
            }
        }
        echo $x;
    }

    /*
     * Delete Sellers Notification when it is a month old and has been read
     * */
    function delete_notification(){
        $query = "SELECT id FROM sellers_notification_message WHERE is_read = 1 AND created_on <= SUBDATE(NOW(), INTERVAL 1 MONTH)";
        $results = $this->db->query( $query )->result();
        $x = 0;
        if( $results ){
            foreach ( $results as $result ){
                try {
                    $this->seller->delete_data( $result->id, 'sellers_notification_message');
                    $x++;
                } catch (Exception $e) {
                }
            }
        }
        echo $x . ' Notification was cleared.';
    }

    /*
     * Delete System Notification
     * */

    public function check(){
        echo 'Philip';
        exit;
    }


}
