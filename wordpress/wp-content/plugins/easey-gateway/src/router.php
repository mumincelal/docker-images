<?php

add_action('rest_api_init', function () {
    register_rest_route('easy-gateway/', '/test/', array(
        'methods' => 'GET',
        'callback' => 'testing'
    ));
    register_rest_route('easy-gateway/revolution-sliders', '/store/', array(
        'methods' => 'POST',
        'callback' => 'revolutionSliderStore',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));
    register_rest_route('easy-gateway/revolution-sliders', '/slides-store/', array(
        'methods' => 'POST',
        'callback' => 'revolutionSlideStore',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));
    register_rest_route('easy-gateway/revolution-sliders', '/update/', array(
        'methods' => 'POST',
        'callback' => 'revolutionSliderUpdate',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));
    register_rest_route('easy-gateway/revolution-sliders', '/sync/', array(
        'methods' => 'GET',
        'callback' => 'revolutionSliderSync',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/pages', '/get-all/', array(
        'methods' => 'GET',
        'callback' => 'getAllClassicPage',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/pages', '/store/', array(
        'methods' => 'POST',
        'callback' => 'storeClassicPage',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/pages', '/update/', array(
        'methods' => 'POST',
        'callback' => 'updateClassicPage',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/pages', '/destroy/', array(
        'methods' => 'POST',
        'callback' => 'deleteClassicPage',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));


    register_rest_route('easy-gateway/blogs', '/get-all/', array(
        'methods' => 'GET',
        'callback' => 'getAllClassicBlogs',

    ));

    register_rest_route('easy-gateway/blogs', '/store/', array(
        'methods' => 'POST',
        'callback' => 'storeClassicBlog',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/blogs', '/update/', array(
        'methods' => 'POST',
        'callback' => 'updateClassicBlog',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/blogs', '/destroy/', array(
        'methods' => 'POST',
        'callback' => 'deleteClassicBlog',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/categories', '/store/', array(
        'methods' => 'POST',
        'callback' => 'storeCategory',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/categories', '/update/', array(
        'methods' => 'POST',
        'callback' => 'updateCategory',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/categories', '/destroy/', array(
        'methods' => 'POST',
        'callback' => 'deleteCategory',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/woocommerce', '/get-token/', array(
        'methods' => 'GET',
        'callback' => 'generateWoocommerceToken',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));

    register_rest_route('easy-gateway/token', '/verification/', array(
        'methods' => 'POST',
        'callback' => 'verification_token'
    ));
    register_rest_route('easy-gateway/system', '/get-all-plugins/', array(
        'methods' => 'GET',
        'callback' => 'getAllPlugins',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));
    register_rest_route('easy-gateway/system', '/get-site-url/', array(
        'methods' => 'GET',
        'callback' => 'getSiteUrl',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));


    register_rest_route('easy-gateway/elementor', '/get-all-blog/', array(
        'methods' => 'GET',
        'callback' => 'getAllElementorBlogs',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));
    register_rest_route('easy-gateway/elementor', '/get-all-page/', array(
        'methods' => 'GET',
        'callback' => 'getAllElementorPages',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));
    register_rest_route('easy-gateway/elementor', '/get-all-widgets/', array(
        'methods' => 'GET',
        'callback' => 'getElementorWidget',
        'permission_callback' => 'easey_api_key_check_middleware',
    ));
    register_rest_route('easy-gateway/elementor', '/get-page-data/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'getElementorDataByPage',
        'permission_callback' => 'easey_api_key_check_middleware',
        'args' => array(
            'id' => array(
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                }
            ),
        ),
    ));
});
