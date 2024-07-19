<?php

namespace PixxelTheme\includes;

/**
 * This file is the maine api
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


/**
 * The main api
 *
 * this class used to fetch data from main database
 *
 */
class Api
{

    function __construct()
    {
    }



    public function generateResponse($type, $url, $options = [], $body = true)
    {
        if ($type == 'post') {
            $api_response = wp_remote_post($url, $options);
        } elseif ($type == 'get') {
            if (count($options)) {
                $api_response = wp_remote_get($url, $options);
            } else {
                $api_response = wp_remote_get($url);
            }
        }
        $result = false;
        if (is_wp_error($api_response)) {
            $result = false;
        }

        if ($body) {
            if (in_array(wp_remote_retrieve_response_code($api_response), [200, 201])) {
                $result = json_decode($api_response['body']);
            }
        } else {
            $result = $api_response;
        }


        return $result;
    }
}
