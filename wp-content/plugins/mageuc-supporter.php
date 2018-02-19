<?php

/**
 * Plugin Name: MageUC Supporter
 */

add_action('wp_enqueue_scripts', 'mageuc_supporter_script_load');
function mageuc_supporter_script_load()
{
    wp_enqueue_script('mageuc_supporter_script_load', get_stylesheet_directory_uri() . '/js/mageuc.supporter.js', array('jquery'));
}
