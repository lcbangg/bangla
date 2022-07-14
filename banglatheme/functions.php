<?php 

function bangla_theme_support(){
    //Add dynamic title tag (WP support)
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme','bangla_theme_support');

function bangla_menus(){
    $location = array(
        'primary' => "Desktop Primary Left Sidebar",
        'footer' => "footer Menu Items"
    );
    register_nav_menus($location);
}
add_action('init','bangla_menus');

function bangla_register_style(){

    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('bangla-fontawesome',"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css",array('bangla-bootstrap'),'5.13.0','all');
    wp_enqueue_style('bangla-bootstrap',"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css",array(),'4.4.1','all');
    wp_enqueue_style('bangla-style',get_template_directory_uri()."/style.css",array(),$version,'all');

}
add_action('wp_enqueue_scripts','bangla_register_style');



function bangla_register_scripts()
{
    wp_enqueue_script('bangla-jquery','https://code.jquery.com/jquery-3.4.1.slim.min.js', array(),'3.4.1',true);
    wp_enqueue_script('bangla-poper','https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(),'1.16.0',true);
    wp_enqueue_script('bangla-bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array(),'4.4.1',true);
    wp_enqueue_script('bangla-main',get_template_directory_uri()."/assets/js/main.js", array(),'3.4.1',true);
}
add_action('wp_enqueue_scripts','bangla_register_scripts');

function bangla_widget_areas(){
    register_sidebar(
        array(
            'before_title' =>'',
            'after_title' => '',
            'before_widget' =>'<ul class="social-list list-inline py-3 mx-auto">',
            'after_widget' => '</ul>',
            'name' => 'Sidebar Area',
            'id' => 'sidebar-1',
            'description' => 'Sidebar Widget Area'
        )
    );
    register_sidebar(
        array(
            'before_title' =>'',
            'after_title' => '',
            'before_widget' =>'<ul class="social-list list-inline py-3 mx-auto">',
            'after_widget' => '</ul>',
            'name' => 'Footer Area',
            'id' => 'footer-1',
            'description' => 'Footer Widget Area'
        )
    );

}
add_action('widgets_init','bangla_widget_areas');


?>