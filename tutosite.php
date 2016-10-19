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

function my_plugin_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>
    <div class="wrap">
        <p>Here is where you can create the tutorial :</p>
    </div>

    <div class="desc">Take a screenshot of your web page, modified it if you like, and upload it in "Tuto"</div><br/>


    <div id="primary">
        <div id="content" class="clearfix">
            <?php


            query_posts( array (
                'post_type' => 'image',
                'posts_per_page' => +1,
                'orderby' =>  array( 'date' => 'ASC')
            ) );

            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <h2><?php the_title() ?></h2>
                <h3><?php the_content() ?></h3>
                <?php the_post_thumbnail('large') ?>

            <?php endwhile; ?>
            <?php next_posts_link(); ?>
            <?php previous_posts_link(); ?>
            <?php else : ?>
            <div class="no"> No posts found </div>
            <?php endif; ?>

        </div><!-- #content -->
    </div><!-- #primary -->



    <?php
}
    add_action( 'init', 'create_post_type' );

    function create_post_type()
    {
        register_post_type('image', array(
            'labels' => $labels = array(
                'name'               => __( 'Tuto', 'post type general name'),
                'singular_name'      => __( 'Tuto', 'post type singular name'),
                'menu_name'          => __( 'Tuto', 'admin menu' ),
                'name_admin_bar'     => __( 'Tuto', 'add new on admin bar' ),
                'add_new'            => __( 'Add Tuto', 'book' ),
                'add_new_item'       => __( 'Add New Tuto', 'your-plugin-textdomain' ),
                'new_item'           => __( 'New Tuto', 'your-plugin-textdomain' ),
                'edit_item'          => __( 'Edit Tuto', 'your-plugin-textdomain' ),
                'view_item'          => __( 'View Tuto', 'your-plugin-textdomain' ),
                'all_items'          => __( 'All Tuto', 'your-plugin-textdomain' ),
                'search_items'       => __( 'Search Tuto', 'your-plugin-textdomain' ),
                'parent_item_colon'  => __( 'Parent Tuto:', 'your-plugin-textdomain' ),
                'not_found'          => __( 'No Tuto found.', 'your-plugin-textdomain' ),
                'not_found_in_trash' => __( 'No Tuto found in Trash.', 'your-plugin-textdomain' )
            ),
            'public' => true
            )
        );
        add_post_type_support('image', array('title', 'editor', 'thumbnail'));

    }


