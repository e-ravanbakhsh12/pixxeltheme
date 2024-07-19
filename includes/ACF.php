<?php

namespace PixxelTheme\includes;

use PhpOffice\PhpSpreadsheet\IOFactory;


if (!defined('ABSPATH')) {
    exit;
}

class ACF
{
    function __construct()
    {
        if (is_admin()) {

            // add acf setting page
            acf_add_options_page(array(
                'page_title' => 'تنظیمات لابل',
                'menu_title' => 'تنظیمات لابل',
                'menu_slug' => 'admin-pixxel-site',
                'capability' => 'edit_posts',
                'redirect' => false,
                'update_button' => 'ذخیره',
            ));

            add_filter('acf/prepare_field/name=excel-file', [$this, 'importExcelFile']);
        }
    }

    // Function to import Excel file and modify field value
    public function importExcelFile($field)
    {
        $attachment_id = $field['value'];
        $file_path = get_attached_file($attachment_id);

        $isExist = file_exists($file_path);
        if ($file_path && file_exists($file_path)) {
            try {
                $reader = IOFactory::createReader('Xlsx');
                $spreadsheet = $reader->load($file_path);
                $sheet = $spreadsheet->getActiveSheet();


                // Loop through rows and handle data

                global $wpdb;
                $table_name = $wpdb->prefix . 'representation_data';
                $wpdb->query("TRUNCATE TABLE $table_name");

                foreach ($sheet->getRowIterator() as $i => $row) {
                    if ($i == 1) continue;
                    $rowData = [];
                    foreach ($row->getCellIterator() as $j => $cell) {
                        // Get cell value and add to row data array
                        switch ($j) {
                            case 'A':
                                $index = 'state';
                                break;
                            case "B":
                                $index = 'city';
                                break;
                            case "C":
                                $index = 'agency';
                                break;
                            case"D":
                                $index = 'address';
                                break;

                            default:
                                # code...
                                break;
                        }
                        $rowData[$index] = $cell->getValue();
                    }

                    $wpdb->insert($table_name, $rowData);
                }
            } catch (\Exception $e) {
                // Handle any errors that might occur during file loading
                error_log('Error loading Excel file: ' . $e->getMessage());
            }
        } else {
            // Log an error if the file path is invalid
            error_log('Invalid file path for attachment ID: ' . $attachment_id);
        }

        // Return the original field value
        return $field;
    }
}
