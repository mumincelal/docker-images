<?php

function getAllElementorBlogs(): array
{
    global $wpdb;


    $query =
        "SELECT *
         FROM {$wpdb->prefix}posts
         WHERE {$wpdb->prefix}posts.post_type = 'post'";
    $blogs = $wpdb->get_results($query);
    return $blogs;
}

function getElementorWidget(): array
{
    $elementor = \Elementor\Plugin::instance();
    $widgets = $elementor->widgets_manager->get_widget_types_config();
    return $widgets;
}

function getElementorDataByPage($args): array
{
    $elementor = \Elementor\Plugin::instance();
    $widgets = $elementor->db->get_builder($args['id']);
    return $widgets;
}

function getAllElementorPages(): array
{
    global $wpdb;

    $query =
        "SELECT {$wpdb->prefix}posts.*, {$wpdb->prefix}postmeta.*
         FROM {$wpdb->prefix}posts
         LEFT JOIN {$wpdb->prefix}postmeta ON wp_posts.ID = {$wpdb->prefix}postmeta.post_id
         WHERE {$wpdb->prefix}posts.post_type = 'page'
         AND {$wpdb->prefix}postmeta.meta_key = '_elementor_data';";
    $posts = $wpdb->get_results($query);
    return $posts;
}
