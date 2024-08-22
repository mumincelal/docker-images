<?php
require_once(ABSPATH . 'wp-admin/includes/taxonomy.php');
#region Pages
function getAllClassicPage()
{
    // WooCommerce'un varsayılan sayfa ID'lerini al
    $woocommerce_page_ids = array();
    $woocommerce_page_options = array(
        'woocommerce_shop_page_id',
        'woocommerce_cart_page_id',
        'woocommerce_checkout_page_id',
        'woocommerce_myaccount_page_id',
        'woocommerce_terms_page_id',
    );

    foreach ($woocommerce_page_options as $option) {
        $page_id = get_option($option);
        if ($page_id) {
            $woocommerce_page_ids[] = $page_id;
        }
    }

    // WooCommerce'un varsayılan sayfaları hariç tut
    $args = array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_elementor_edit_mode',
                'value' => 'builder',
                'compare' => 'NOT EXISTS', // Elementor ile oluşturulmamış sayfaları getir
            )
        ),
        'post__not_in' => $woocommerce_page_ids, // WooCommerce'un varsayılan sayfalarını hariç tut
    );

    $pages = get_posts($args);

    return $pages;
}

function storeClassicPage($request) {

    $data = [
        'post_title'   => $request['title'],
        'post_content' => $request['content'],
        'post_status'  => $request['publish_status'],
        'comment_status'  => $request['comment_status'],
        'post_type'    => 'page',
    ];

    $pageId = wp_insert_post($data);


    if (is_wp_error($pageId)) {
        return $pageId->get_error_message();
    }

    $page = get_post($pageId);

    if (!$page) {
        return 'Sayfa bulunamadı.';
    }


    $page->permalink = get_permalink($pageId);


    return $page;
}

function updateClassicPage($request) {

    $data = [
        'ID' => $request['remote_id'],
        'post_title'   => $request['title'],
        'post_content' => $request['content'],
        'post_status'  => $request['publish_status'],
        'comment_status'  => $request['comment_status'],
        'post_type'    => 'page',
    ];

    $pageId = wp_update_post($data);

    if (is_wp_error($pageId)) {
        return $pageId->get_error_message();
    }

    $page = get_post($pageId);

    if (!$page) {
        return 'Sayfa bulunamadı.';
    }


    $page->permalink = get_permalink($pageId);


    return $page;
}

function deleteClassicPage($request) {
    $pageId = $request['id'];

    $deletedPage = wp_delete_post($pageId, false);

    if (!$deletedPage) {
        return 'Sayfa silinirken bir hata oluştu veya sayfa bulunamadı.';
    }

    return 'Sayfa başarıyla silindi.';
}



#region Blogs
function getAllClassicBlogs()
{
    // WooCommerce'un varsayılan sayfa ID'lerini al
    $woocommerce_page_ids = array();
    $woocommerce_page_options = array(
        'woocommerce_shop_page_id',
        'woocommerce_cart_page_id',
        'woocommerce_checkout_page_id',
        'woocommerce_myaccount_page_id',
        'woocommerce_terms_page_id',
    );

    foreach ($woocommerce_page_options as $option) {
        $page_id = get_option($option);
        if ($page_id) {
            $woocommerce_page_ids[] = $page_id;
        }
    }

    // WooCommerce'un varsayılan sayfaları hariç tut
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_elementor_edit_mode',
                'value' => 'builder',
                'compare' => 'NOT EXISTS', // Elementor ile oluşturulmamış sayfaları getir
            )
        ),
        'post__not_in' => $woocommerce_page_ids, // WooCommerce'un varsayılan sayfalarını hariç tut
    );

    $pages = get_posts($args);

    return $pages;
}

function storeClassicBlog($request) {

    $data = [
        'post_title'   => $request['title'],
        'post_content' => $request['content'],
        'post_status'  => $request['publish_status'],
        'comment_status'  => $request['comment_status'],
        'tags_input'  => $request['tags'],
        'post_type'    => 'post',
    ];

    $postId = wp_insert_post($data);

    if (is_wp_error($postId)) {
        return $postId->get_error_message();
    }

    $post = get_post($postId);

    if (!$post) {
        return 'Blog Yazısı bulunamadı.';
    }


    $post->permalink = get_permalink($postId);


    return $post;
}

function updateClassicBlog($request) {

    $data = [
        'ID' => $request['remote_id'],
        'post_title'   => $request['title'],
        'post_content' => $request['content'],
        'post_status'  => $request['publish_status'],
        'comment_status'  => $request['comment_status'],
        'tags_input'  => $request['tags'],
        'post_type'    => 'post',
    ];

    $postId = wp_update_post($data);

    if (is_wp_error($postId)) {
        return $postId->get_error_message();
    }

    $post = get_post($postId);

    if (!$post) {
        return 'Blog Yazısı bulunamadı.';
    }


    $post->permalink = get_permalink($postId);


    return $post;
}

function deleteClassicBlog($request) {
    $blogId = $request['remote_id'];

    $deletedPage = wp_delete_post($blogId, false);

    if (!$deletedPage) {
        return 'Blog silinirken bir hata oluştu veya sayfa bulunamadı.';
    }

    return 'Blog başarıyla silindi.';
}

function storeCategory($request)
{
    $data = [
        'cat_name'   => $request['name'],
        'category_description' => $request['description'],
        'category_parent'  => $request['parent_id'],
        'taxonomy'  => 'category',
    ];

    $categoryId = wp_insert_category($data);

    if (is_wp_error($categoryId)){
        return $categoryId->get_error_message();
    }

    $category = get_category($categoryId);

    $category->permalink = get_permalink($categoryId);

    return $category;
}

function updateCategory($request)
{
    $data = [
        'cat_ID' => $request['remote_id'],
        'cat_name'   => $request['name'],
        'category_description' => $request['description'],
        'category_parent'  => $request['parent_id'],
        'taxonomy'  => 'category',
    ];

    $categoryId = wp_update_category($data);

    if (is_wp_error($categoryId)){
        return $categoryId->get_error_message();
    }

    $category = get_category($categoryId);

    $category->permalink = get_permalink($categoryId);

    return $category;
}

function deleteCategory($request)
{
    $categoryId = $request['remote_id'];
    $deletedPage = wp_delete_category($categoryId);
    if (!$deletedPage) {
        return false;
    }

    return true;
}