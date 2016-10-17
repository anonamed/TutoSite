<?php
/*
Plugin Name: TutoSite
Description: Un plugin servant à créer un tutoriel d'utilisation
Version: 0.1
Author: Hugo Ft
License: GPL2
*/

add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
    add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}

function my_plugin_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    echo '<div class="wrap">';
    echo '<p>Here is where you can modified the option for create the tutorial :</p>';
    echo '</div>';
}