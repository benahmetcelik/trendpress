<?php
/**
 * Plugin Name: TrendPress
 * Plugin URI: https://www.webkedi.net/
 * Description: Beta Sürümüdür.
 * Version: 0.1
 * Author: WebKedi
 * Author URI: https://webkedi.net/
 **/

//call the 'add_menu_page' function with 'admin_menu' action hook
// Define constants
define('PLUGIN_SLUG', 'trendpress');
define('PLUGIN_ROLE', 'manage_options');
define('PLUGIN_DOMAIN', 'trendpress');
define('TRENDPRESS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('TRENDPRESS_PLUGIN_URİ', plugin_dir_url(__FILE__));


function tp_page_render($view)
{
    if (is_admin()) {
        include plugin_dir_path(__FILE__) . 'views/layouts/header.php';
        include plugin_dir_path(__FILE__) . 'views/pages/' . $view . '.php';
        include plugin_dir_path(__FILE__) . 'views/layouts/footer.php';
    }
}


add_action('admin_menu', 'tp_menu_hook', 9);

function tp_menu_hook()
{
    add_menu_page(
        __('TrendPress', PLUGIN_DOMAIN),
        'TrendPress',
        PLUGIN_ROLE,
        PLUGIN_SLUG,
        false,
        'dashicons-superhero',
        ''
    );
    add_submenu_page(
        PLUGIN_SLUG,
        'Kategoriden Çek',
        'Kategoriden Çek',
        PLUGIN_ROLE,
        PLUGIN_SLUG,
        'tp_by_categories_page',
    );
}

function tp_by_categories_page()
{
    tp_page_render('by_categories');
}

add_action('admin_menu', 'tp_by_brand_page_hook', 9);
function tp_by_brand_page_hook()
{
    add_submenu_page(
        PLUGIN_SLUG,
        'Markadan Çek',
        'Markadan Çek',
        PLUGIN_ROLE,
        'by_brands',
        'tp_by_brand_page',
    );
}

function tp_by_brand_page()
{
    tp_page_render('by_brands');
}

add_action('admin_menu', 'tp_menu_by_seller_page_hook', 9);

function tp_menu_by_seller_page_hook()
{
    add_submenu_page(
        PLUGIN_SLUG,
        'Satıcıdan Çek',
        'Satıcıdan Çek',
        PLUGIN_ROLE,
        'by_sellers',
        'tp_by_sellers_page',
    );
}

function tp_by_sellers_page()
{
    tp_page_render('by_sellers');
}


add_action('admin_menu', 'tp_menu_spin_page_hook', 9);

function tp_menu_spin_page_hook()
{
    add_submenu_page(
        PLUGIN_SLUG,
        'Spin Yaz',
        'Spin Yaz',
        PLUGIN_ROLE,
        'spin',
        'tp_spin_page',
    );
}

function tp_spin_page()
{
    tp_page_render('spin');
}


add_action("wp_ajax_tp_spin_save", "tp_spin_save");

function tp_spin_save()
{
    $data = $_REQUEST['file_data'];
    $data = str_replace('\"', '"', $data);
    $data = str_replace("{\"", '{"', $data);
    $file = fopen(TRENDPRESS_PLUGIN_DIR . "assets/spin.json", "w");
    fwrite($file, $data);
    fclose($file);

}


add_action("wp_ajax_tp_category_ajax", "tp_category_ajax");
function tp_category_ajax()
{
    require_once TRENDPRESS_PLUGIN_DIR . 'functions.php';
    $source_category = $_REQUEST['source_category'];
    $fligran = $_REQUEST['fligran'];
    $spin = $_REQUEST['spin'];
    $publish_status = $_REQUEST['publish_status'];
    $double_spin = $_REQUEST['double_spin'];
    $category_id = $_REQUEST['my_category'];
   
    $commission_type = $_REQUEST['commission_type'];
    $commission_amount = $_REQUEST['commission_amount'];
    require_once TRENDPRESS_PLUGIN_DIR . 'Trendyol.php';
    $trendpress = new Trendyol();
   $products = $trendpress->infinite_scrolls($source_category);
    if (count($products) > 0){
        foreach ($products as $product) {
            $id = rand(0, 99999999) . rand(0, 99999999);
            tp_create_product($id,$product, $category_id, $fligran, $spin, $publish_status, $double_spin,$commission_type,$commission_amount);
         
            }
    }
}


add_action("wp_ajax_tp_seller_ajax", "tp_seller_ajax");
function tp_seller_ajax()
{

    require_once TRENDPRESS_PLUGIN_DIR . 'functions.php';
    $seller_id = $_REQUEST['seller_id'];
    $fligran = $_REQUEST['fligran'];
    $spin = $_REQUEST['spin'];
    $publish_status = $_REQUEST['publish_status'];
    $double_spin = $_REQUEST['double_spin'];
    $category_id = $_REQUEST['my_category'];
    $commission_type = $_REQUEST['commission_type'];
    $commission_amount = $_REQUEST['commission_amount'];
    require_once TRENDPRESS_PLUGIN_DIR . 'Trendyol.php';
    $trendpress = new Trendyol();

    $products = $trendpress->by_seller($seller_id);


    if (count($products) > 0){
        $i = 1;
        foreach ($products as $product) {
            $id = rand(0, 99999999) . rand(0, 99999999);
            tp_create_product($id,$product, $category_id, $fligran, $spin, $publish_status, $double_spin,$commission_type,$commission_amount);
            die();
        }
    }
}


add_action("wp_ajax_tp_brand_ajax", "tp_brand_ajax");
function tp_brand_ajax()
{

    require_once TRENDPRESS_PLUGIN_DIR . 'functions.php';
    $brand_id = $_REQUEST['source_brand'];
    $fligran = $_REQUEST['fligran'];
    $spin = $_REQUEST['spin'];
    $publish_status = $_REQUEST['publish_status'];
    $double_spin = $_REQUEST['double_spin'];
    $category_id = $_REQUEST['my_category'];
    $commission_type = $_REQUEST['commission_type'];
    $commission_amount = $_REQUEST['commission_amount'];
    require_once TRENDPRESS_PLUGIN_DIR . 'Trendyol.php';
    $trendpress = new Trendyol();
    $products = $trendpress->infinite_scrolls('sr?wb='.$brand_id.'&os=1');
    if (count($products) > 0){
        $i = 1;
        foreach ($products as $product) {
            $id = rand(0, 99999999) . rand(0, 99999999);

            tp_create_product($id,$product, $category_id, $fligran, $spin, $publish_status, $double_spin,$commission_type,$commission_amount);
        }
    }
}

add_action('admin_menu', 'tp_docs_page_hook', 9);
function tp_docs_page_hook()
{
    add_submenu_page(
        PLUGIN_SLUG,
        'Dökümantasyon',
        'Dökümantasyon',
        PLUGIN_ROLE,
        'docs',
        'tp_docs_page',
    );
}

function tp_docs_page()
{
    tp_page_render('docs');
}


