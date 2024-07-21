<?php

function persianSort($a, $b) {
    $collator = new Collator('fa_IR');
    return $collator->compare($a, $b);
}

function isLocalhost()
{
    return in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '192.168.1.51', '192.168.1.50'));
}

function getFirstParagraph($content)
{

    $str = $content;
    $str = substr($str, 0, strpos($str, '</p>') + 4);
    $str = strip_tags($str, '');
    return  $str;
}

function sortByPersianAlphabet($drugs)
{
    $sorted_data = [];
    foreach ($drugs as $drug) {
        $first = mb_substr($drug->PersianName, 0, 1, 'utf-8');
        if ($first == 'ا' || $first == 'آ') {
            $first = 'الف';
        }
        $sorted_data[$first][] = $drug;
    }
    return  $sorted_data;
}

function isAdministrator()
{
    $response = false;
    if (is_user_logged_in()) {
        $user = wp_get_current_user(); // getting & setting the current user 
        $roles = (array) $user->roles;
        if (in_array('administrator', $roles)) {
            $response = true;
        }
    }
    return $response;
}


function explodeUrl()
{
    $exploded_url = explode('/', $_SERVER['REQUEST_URI']);
    if (strpos(end($exploded_url), '?') == 0) {
        unset($exploded_url[count($exploded_url) - 1]);
    }
    return $exploded_url;
}
function explodeUrlWithQuery($url = false)
{
    if ($url) {
        $exploded_url = explode('/', wp_parse_url($url)['path']);
    } else {
        $exploded_url = explode('/', $_SERVER['REQUEST_URI']);
    }

    if (strpos(end($exploded_url), '?') === 0) {
        $removed_question_mark = substr(end($exploded_url), 1);
        $query_strings = explode('&', $removed_question_mark);
        unset($exploded_url[count($exploded_url) - 1]);
        $result['query-string'] = $query_strings;
    }
    $i = 1;
    if (isLocalhost()) {
        $i = 0;
    }
    foreach ($exploded_url as $url) {
        if (empty($url)) continue;
        $result['main-url'][$i] = $url;
        $i++;
    }
    return $result;
}


function ajaxResponse($success = true, $message = null, $content = null)
{

    $response = array(
        'success' => $success,
        'message' => $message,
        'content' => $content
    );

    wp_send_json($response);
}

function backEndData()
{
    return array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'homeUrl' => get_home_url(),
        'remoteIp' => $_SERVER['REMOTE_ADDR'],
        'templateUri' => get_template_directory_uri(),
        'loggedIn' => is_user_logged_in() || $_SESSION['haal-user-data']['type'] == 'forum_consultant',
        'wordPressLoggedIn' => is_user_logged_in(),
        'expandedUrl' => explodeUrlWithQuery()['main-url'],

    );
}

function isRoleExists($role)
{

    if (!empty($role)) {
        return $GLOBALS['wp_roles']->is_role($role);
    }

    return false;
}

function getUserIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getPageIdByTemplate( $template ) {
    $args = [
        'post_type'  => 'page',
        'fields'     => 'ids',
        'nopaging'   => true,
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template
    ];
    $pages = get_posts( $args );
    return $pages;
}

function sanitizeNestedObject( $object ) {
    // Create an empty array to store the sanitized object
    $sanitized_object = array();

    // Loop through each key-value pair in the object
    foreach ( $object as $key => $value ) {
        // If the value is an array, recursively sanitize it
        if ( is_array( $value ) || is_object( $value )) {
            $sanitized_object[ $key ] = /* todo */sanitizeNestedObject((array)$value );
        }
        // If the value is a string, sanitize it using wp_kses
        elseif ( is_string( $value ) ) {
            $sanitized_object[ $key ] = sanitize_text_field($value);
            // $sanitized_object[ $key ] = wp_kses( $value, array(
            //     'a' => array(
            //         'href' => array(),
            //         'title' => array()
            //     ),
            //     'img' => array(
            //         'src' => array(),
            //         'alt' => array()
            //     )
            //     // Add more allowed tags and attributes as needed
            // ) );
        }
        // If the value is neither an array nor a string, keep it as is
        else {
            $sanitized_object[ $key ] = $value;
        }
    }
    return $sanitized_object;
}

function isTopDomain()
{
    return strpos($_SERVER['HTTP_HOST'], 'pixxel.top') !== false ? true : false;
}

