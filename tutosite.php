<?php
/*
Plugin Name: TutoSite
Description: Un plugin servant à créer un tutoriel d'utilisation
Version: 0.1
Author: Hugo Ft
License: GPL3
*/

add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
    add_options_page( 'TutoSite Options', 'TutoSite', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}

function my_plugin_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    echo '<div class="wrap">';
    echo '<p>Here is where you can modified the option for create the tutorial :</p>';
    echo '</div>';
}

function modified_balise() {
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js', null, '3.1.0', 'true');
    add_action('wp_footer', 'modified_balise_script');
}

function modified_balise_script() {
    ?>
    <script type="text/javascript">
        (function($){
            $('modified_balise')
        })(jQuery);
    </script>
<?php
}