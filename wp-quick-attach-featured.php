<?php
/**
 * Plugin Name: Quick Attach Featured Image
 * Plugin URL: https://github.com/rohan-krishna/wp-quick-attach-featured
 * Description: Enables admins to quickly attach featured images to posts.
 * Version: 0.0.1
 * Author: Rohan Krishna <phonemg30993@gmail.com>
 * Author URI: https://github.com/rohan-krishna
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html

{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {URI to Plugin License}.
 
*/

// Register new post type "book"
// function wpaqfi_setup_post_type_book() {
//     register_post_type( 'book', ['public' => true]);
// }
// add_action( 'init', 'wpaqfi_setup_post_type_book' );

/*
enqueue_styles
*/
function wpaqfi_custom_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('media-uploader', plugin_dir_url(__FILE__) . 'admin/js/wp-media-uploader.js', array('jquery'));
    wp_enqueue_script('datatable-js', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js', array('jquery'));

    wp_enqueue_style( 'wpaqfi_tailwindcss', plugin_dir_url(__FILE__) . 'admin/css/zing.css', []);
    wp_enqueue_style( 'datatable-css', 'https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/jquery.dataTables.min.css', []);
}

add_action( 'admin_enqueue_scripts', 'wpaqfi_custom_scripts' );

/*
Add Menu Item
*/

add_action( 'admin_menu', 'wpaqfi_add_menu' );
function wpaqfi_add_menu() {
    add_menu_page(
        "Quick Attach Featured Image",
        "Quick Attach Featured Image",
        "manage_options",
        "wpaqfi",
        'wpaqfi_main_page_html',
        // plugin_dir_url(__FILE__) . 'admin/images/icon.png',
        null,
        5
    );
}

function wpaqfi_main_page_html() {
    // return require( plugin_dir_url(__FILE__) . 'admin/view.php');
    if (isset($_POST['wpaqfi-submitted'])) {
        var_dump($_POST['post_id']);
    }
    include( plugin_dir_path(__FILE__) . 'admin/view.php');
    // echo '<div class="wrap">';
    // echo '<h1 class="text-3xl">Hello World!</h1>';
    // echo '</div>';
}





// /*
// Activation Hook
// */
// function wpaqfi_activate() {
//     // wpaqfi_setup_post_type_book();
//     wpaqfi_add_menu();
//     wpaqfi_enqueue_styles();
//     flush_rewrite_rules();
// }
// register_activation_hook(__FILE__, 'wpaqfi_activate');

// /*
// De-activation Hook
// */
// function wpaqfi_deactivate() {
//     flush_rewrite_rules();
// }

// register_deactivation_hook( __FILE__, 'wpaqfi_deactivate' );