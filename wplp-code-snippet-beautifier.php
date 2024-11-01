<?php
/**
 * Plugin Name:       Code Snippet Beautifier
 * Description:       This plugin is used for beautify Code Snippet on website.
 * Version:           1.0.0
 * Author:            WP Labour Party
 * Author URI:        https://wplabourparty.com/
 * Text Domain:       wplp-code-snippet
 */
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}


/* * ****** DEFINING CONSTANTS ********* */
define('WPLP_VERSION', '1.0.0');
define('WPLP_SLUG', 'wplp-code-snippet');
define('WPLP_FULL_NAME', 'Code Snippet Beautifier');
define('WPLP_PLUGIN_FILE', __FILE__);
define('WPLP_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('WPLP_PLUGIN_DIR', plugin_dir_path(__FILE__));

/**
 * Function to Enqueue General Scripts and Styles
 */
function wplp_column_block_extend_assets() {
    wp_enqueue_script(
            'wplp_code_snippet_block_js', plugins_url('blocks/code-snippet/block.js', __FILE__), array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-edit-post'), time(), true);

}

add_action('enqueue_block_assets', 'wplp_column_block_extend_assets');

/**
 * Function to Enqueue Code Snippets Frontend Specific Scripts and Styles
 */
function wplp_code_snippet_scripts() {

    wp_register_script('prism-js', plugins_url('blocks/code-snippet/assets/js/prism.js', __FILE__), array(), true);

    wp_register_style('prism-css', plugins_url('blocks/code-snippet/assets/css/prism.css', __FILE__));

    wp_register_style('prism-line-numbers-css', plugins_url('blocks/code-snippet/assets/css/line-numbers.css', __FILE__));

    wp_register_script('prism-line-numbers', plugins_url('blocks/code-snippet/assets/js/line-numbers.js', __FILE__), array(), true);

    if (!is_admin()) {
        wp_enqueue_script('prism-js');
        wp_enqueue_style('prism-css');
        wp_enqueue_style('prism-line-numbers-css');
        wp_enqueue_script('prism-line-numbers');
    }

}

add_action('enqueue_block_assets', 'wplp_code_snippet_scripts');

/**
 * Function to Enqueue Editor Specific Scripts and Styles
 */
function wplp_backend_scripts() {
    wp_register_style('wplp-admin-style', plugins_url('assets/css/admin-style.css', __FILE__));

    wp_enqueue_style('wplp-admin-style');
}

add_action('enqueue_block_editor_assets', 'wplp_backend_scripts');

require plugin_dir_path(__FILE__) . 'blocks/code-snippet/render.php';

