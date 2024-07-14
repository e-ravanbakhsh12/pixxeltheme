<?php

namespace PixxelTheme\includes;



if (!defined('ABSPATH')) {
    exit;
}

class Activation
{
    function __construct()
    {
        
    }

     /**
     * Generate the Representation table in the database.
     */
    public function generateRepresentationTable(): void
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'representation_data';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "
        CREATE TABLE IF NOT EXISTS $table_name (
        ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        state varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
        city varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
        agency varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
        address text COLLATE utf8mb4_unicode_ci NOT NULL,
        PRIMARY KEY (ID),
        KEY agency (agency)
        ) ENGINE=InnoDB $charset_collate;
        ";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}
