<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: SokoyaPhilip
 * Date: 2/7/2019
 * Time: 10:15 PM
 */
class Ajax extends CI_Controller {

    function load_sales_data(){
        if( $this->input->is_ajax_request() ){
            $type = $this->input->post_get('type', true);
            $results = array();
            switch ( $type) {
                case 'weekly':
                    $results = $this->seller->load_sales_data('weekly');
                    break;
                case 'monthly':
                    $results = $this->seller->load_sales_data('monthly');
                    break;
                case 'yearly':
                    $results = $this->seller->load_sales_data('yearly');
                    break;
                default:
                    $results = $this->seller->load_sales_data();
                    break;
            }
            header('Content-type: text/json');
            header('Content-type: application/json');
            echo json_encode( $results ); exit;
        }
    }
//    function get_hourly_graph() {
//        // First lets create a daily graph for experiment then we can build on that
//        date_default_timezone_set('Africa/Lagos');
//        $current_hour = date('H');
//        // SQL Query to get data we want
//        $sql = mysql_query("SELECT hour( time_hit ) AS hour , count( hour( time_hit ) ) AS hits FROM hits WHERE time_hit > now( ) - INTERVAL 1 DAY GROUP BY hour( time_hit );")
//        or die(mysql_error());
//
//        // Remove an hour off current time for array and the loop that will put the data into the array
//        $array_hour = $current_hour - 1;
//
//        // Add a 0 if the timer is under 10. just so this is compatable with the SQL data
//        if ($array_hour < 10) {
//            $array_hour = 0 . $array_hour;
//        }
//
//        // initialise the array so we can set up the indexes and data in the next couple of loops
//        $hit_data = array();
//
//        // Work back the clock 24 hours and create the array indexes
//        for ($i = 0; $i < 24; $i++) {
//            $new_hour = $current_hour;
//
//            if ($new_hour < 1) {
//                $new_hour = 24;
//                $hit_data[$new_hour] = "0";
//            }
//            else {
//                $hit_data[$new_hour] = "0";
//            }
//
//            $current_hour = $new_hour - 1;
//        }
//
//        // Loop through  the rest of the array and replace null with 0s
//        while ($results = mysql_fetch_array($sql, MYSQL_ASSOC)) {
//            foreach ($hit_data as $hour => $hits) {
//                if ($results['hour'] == $hour) {
//                    $hit_data[$hour] = $results['hits'];
//                }
//            }
//        }
//
//        $hit_data = array_reverse($hit_data, true);
//
//        // Generate the graph for the 24 hour data
//        generate_graph ($hit_data, '24 Hour Report', 'hourly_graph.png', 'Time (Hours)', 'Hits');
//    }

}