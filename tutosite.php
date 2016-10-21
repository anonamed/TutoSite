<?php
/*
Plugin Name: TutoSite
Description: Un plugin servant à créer un tutoriel d'utilisation
Version: 0.1
Author: Hugo Ft
License: GPL3
*/

function ap_action_init()
{
    load_plugin_textdomain( 'tutosite', false, plugin_basename( dirname(__FILE__) ) . '/lang' );
}
add_action('init', 'ap_action_init');

add_action( 'admin_menu', 'my_plugin_menu' );


function my_plugin_menu() {
    add_options_page( 'TutoSite Options', 'TutoSite', 'manage_options', 'tutosite', 'my_plugin_options' );

}

function my_plugin_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>
    <div class="wrap">
        <p><?php _e( 'Here is where you can create the tutorial :', 'tutosite' );?></p>
    </div>

    <div class="descri"><?php _e( 'Take a screenshot of your web page, modified the screen if you like, and upload it in Tuto (max 5 screens)', 'tutosite' );?></div><br/>


    <div id="primary">
        <div id="content" class="clearfix">
            <?php

            query_posts( array (
                'post_type' => 'image',
                'posts_per_page' => 5,
                'orderby' =>  array( 'date' => 'ASC')
            ) );

            echo '<div id="tutos">';

            $i = 0;
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?php // ternaire => $class = ($i == 0) ? 'show' : ''; $i = 1; ?>
                <?php
                    if($i == 0) {
                        $i = 1;
                        $class = ' show';
                    } else {
                        $class = '';
                    }
                ?>
                <div id="tuto-<?php the_ID(); ?> " class="tuto<?php echo $class ?>"><h2> <?php the_title() ?> </h2>
                <h3> <?php the_content() ?> </h3>
                <?php the_post_thumbnail('large'); ?></div>
            <?php endwhile ?>
            <button class="button-pre"><< Previous</button>&nbsp;
            <button class="button-nex">Next >></button>
            </div><br/>


            <style type="text/css">
                #tutos > div {
                    display: none;
                }
                #tutos .show {
                    display: block;
                }
            </style>
            <script type="text/javascript">
                $ = jQuery;
                $(document).ready(function (){

                    $classTutos = $('#tutos .tuto').length - 1;
                    $('.button-pre').hide();

                    /****** next *********/

                    $('#tutos .button-nex').on('click', function(){

                        $current = $('#tutos .show').index();

                        if($current == $classTutos) {
                            $current = $classTutos;
                        } else {
                            $('.button-nex').show();

                            $('.button-pre').show();
                            $current += 1;
                        }

                        if($current == $classTutos) {
                            $('.button-nex').hide();
                        }

                        $('#tutos .tuto').removeClass('show');
                        $('#tutos .tuto').eq($current).addClass('show');

                        window.top.window.scrollTo(0,0);

                    });

                        /********** previous ************/


                    $('#tutos .button-pre').on('click', function(){

                        $current = $('#tutos .show').index();

                        if($current == 0) {
                            $current = 0;
                            $('.button-nex').show();
                        } else {
                            $('.button-nex').show();
                            $current -= 1;
                        }

                        if($current == 0) {
                            $('.button-pre').hide();
                        }

                        $('#tutos .tuto').removeClass('show');
                        $('#tutos .tuto').eq($current).addClass('show');

                        window.top.window.scrollTo(0,0);
                    });

                    /*if (){
                     $('.button-nex').hide;
                     } else {
                     $('.button-nex').show;
                     }
                     if (){
                     $('.button-prev').hide;
                     } else {
                     $('.button-prev').show;
                     }*/

                });
            </script>

            <?php else : ?>
            <div class="no"> No posts found :/ </div>
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


