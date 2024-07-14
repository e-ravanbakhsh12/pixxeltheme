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
    // crm form api
    public  function setCrmForm($form)
    {
        $url = 'https://my.labell.ir/crmform/api/index.php';

        $defaultForm = ["token" => "BtmtGGRJFhJS8OJEDXh6sYuyDLxjnYLE"];
        // Merge the form data with default values
        $form_data = array_merge($defaultForm, $form);
        $body = $form_data; // Encode entire form data as JSON

        $options = [
            'method' => 'POST',
            'headers' => [],
            'body' => $body,
            'timeout' => 60,
        ];

        return wp_remote_post($url, $options);
    }

    public  function setCrmFormFile($body,$headers)
    {
        $url = 'https://cp.labell.ir/crmform/api/index.php';

        $options = [
            'method' => 'POST',
            'headers' => $headers,
            'body' => $body,
            'timeout' => 60,
        ];

        return wp_remote_post($url, $options);
    }

    // Helper function to build multipart form data
    private function buildMultipartData($data, $boundary)
    {
        $multipart = '';
        foreach ($data as $key => $value) {
            if (is_array($value)) { // Handle nested arrays (like $_FILES)
                $multipart .= $this->buildMultipartData($value, $boundary, $key);
            } else {
                $multipart .= "--" . $boundary . "\r\n";
                $multipart .= 'Content-Disposition: form-data; name="' . $key . '"' . "\r\n\r\n";
                $multipart .= $value . "\r\n";
            }
        }
        $multipart .= "--" . $boundary . "--\r\n";
        return $multipart;
    }

    public  function getDependencies($type)
    {
        $url = 'https://my.labell.ir/crmform/api/dependencies.php?type=' . $type;

        $result = $this->generateResponse('get', $url);
        return $result;
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
