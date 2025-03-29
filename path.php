<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

$enLigne = false; // Set this to true for online, false for offline

if ($enLigne) {

    $http_host  = "https://$_SERVER[HTTP_HOST]";
    $php_self   = explode(".", $_SERVER['PHP_SELF'])[0];
    $http_model = "https://$_SERVER[HTTP_HOST]/model/update/create?action=";
    $http_delete = "https://$_SERVER[HTTP_HOST]/model/delete/index?";
    $http_cart  = $http_host . "/model/update/cart?action=";

    define('admin_uri', $http_host . "/dashboard");
    define('admin_url', $http_host . "/dashboard/");

    define('model_url', $http_model);

    define('base_uri', "https://hellodaktari.org");
    define('base_url', "https://hellodaktari.org/");

    define('creator_uri', "https://hellodaktari.org/");
    define('creator_url', "https://hellodaktari.org");

    define('delete_url', "$http_delete");

    define('doctor_url', $http_host . "/doctor/");
    define('doctor_uri', $http_host . "/doctor");

    define('client_url', $http_host . "/client/");
    define('client_uri', $http_host . "/client");

    define('cart_url', "$http_cart");


    define('cookie_domain', "$_SERVER[HTTP_HOST]");

    define('ROOT_PATH', realpath(dirname(__FILE__)) . '/backoffice/');
    define('MODEL_PATH', realpath(dirname(__FILE__)) . '/model/');

    // define('file_url', "$http_host/images/");
    define('file_url', 'https://hellodaktari.org/uploads/images/');
    define('doc_url', 'https://hellodaktari.org/uploads/files/');
    define('signature_url', 'https://hellodaktari.org/doctor/signatures/');
    define('pdf_uri', 'https://hellodaktari.org/prescription/index');

    // define('TARGET_DIR', realpath(dirname(__FILE__)) . '/');
    define('TARGET_DIR', "/home/hellodaktari/public_html/uploads/");
    // define('TARGET_DIR', "/home/hellodaktari/public_html/log/");
} else {
    $http_host  = "https://$_SERVER[HTTP_HOST]";
    $php_self   = explode(".", $_SERVER['PHP_SELF'])[0];
    $http_model = "https://$_SERVER[HTTP_HOST]/model/update/create?action=";
    $http_delete = "https://$_SERVER[HTTP_HOST]/model/delete/index?";
    $http_cart  = $http_host . "/model/update/cart?action=";

    define('admin_uri', $http_host . "/dashboard");
    define('admin_url', $http_host . "/dashboard/");

    define('model_url', $http_model);

    define('base_uri', "https://hellodaktari.org");
    define('base_url', "https://hellodaktari.org/");

    define('creator_uri', "https://hellodaktari.org/");
    define('creator_url', "https://hellodaktari.org");

    define('delete_url', "$http_delete");

    define('doctor_url', $http_host . "/doctor/");
    define('doctor_uri', $http_host . "/doctor");

    define('client_url', $http_host . "/client/");
    define('client_uri', $http_host . "/client");

    define('cart_url', "$http_cart");


    define('cookie_domain', "$_SERVER[HTTP_HOST]");

    define('ROOT_PATH', realpath(dirname(__FILE__)) . '/backoffice/');
    define('MODEL_PATH', realpath(dirname(__FILE__)) . '/model/');

    // define('file_url', "$http_host/images/");
    define('file_url', 'https://hellodaktari.org/uploads/images/');
    define('doc_url', 'https://hellodaktari.org/uploads/files/');
    define('signature_url', 'https://hellodaktari.org/doctor/signatures/');
    define('pdf_uri', 'https://hellodaktari.org/prescription/index');

    // define('TARGET_DIR', realpath(dirname(__FILE__)) . '/');
    define('TARGET_DIR', "/home/hellodaktari/public_html/uploads/");
    // define('TARGET_DIR', "/home/hellodaktari/public_html/log/");
}
