<?php

/*
  Plugin Name: nexgi curr wise payment gateway
  Description: Manage curr wise payment gateway
  Version: 2.45
  Author: NexGen WordPress Plugin Development Team
  Author URI: https://www.nexgi.com/
  Text Domain: nexgi-curr-wise-payment-gateway
 */

add_filter('woocommerce_available_payment_gateways', 'custom_available_payment_gateways');

function custom_available_payment_gateways($available_gateways) {


    // Not in backend (admin)
    if (is_admin())
        return $available_gateways;

    $currPaymentGateways = array(
        "INR" => array(
            'cod',
            'paytm'
        ),
        "USD" => array('paypal')
    );
    $settings = WOOMULTI_CURRENCY_F_Data::get_ins();
    $currCurrCode = $settings->get_current_currency();
 
    if (!isset($currPaymentGateways[$currCurrCode])) {
        return $available_gateways;
    }
    foreach ($available_gateways as $key => $gateway_data) {
        if (!in_array($key, $currPaymentGateways[$currCurrCode])) {
            unset($available_gateways[$key]);
        }
    }

//     echo "<pre>";
//        print_r($available_gateways);
//    $url_arr = explode('/', $_SERVER['REQUEST_URI']);
//    print_r($url_arr);
//        echo "</pre>";   
//    if ($url_arr[1] == 'checkout' && $url_arr[2] == 'order-pay' && is_user_logged_in()) {
//        $settings = WOOMULTI_CURRENCY_F_Data::get_ins();
//        $currCurrCode =  $settings->get_current_currency();
//        echo $currCurrCode;
////        $order_id = intval($url_arr[3]);
////        $order = wc_get_order($order_id);
////        if( $order->has_status('pending') )
////            unset( $available_gateways['cod'] );
////        else
////            unset( $available_gateways['paypal'] );
//        echo "<pre>";
//        print_r($available_gateways);
//        echo "</pre>";
//    } else
//        unset($gateways['paypal']);

    return $available_gateways;
}
