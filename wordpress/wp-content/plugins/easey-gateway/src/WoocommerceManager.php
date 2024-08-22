<?php



function generateWoocommerceToken()
{
    global $wpdb;
    $app_name = "Easy Generate";
    $scope = "read_write";

    $description = sprintf(
        '%s - API (%s)',
        wc_trim_string(wc_clean($app_name), 170),
        gmdate('Y-m-d H:i:s')
    );
    $user = wp_get_current_user();

    // Created API keys.
    $permissions = in_array($scope, array('read', 'write', 'read_write'), true) ? sanitize_text_field($scope) : 'read';
    $consumer_key = 'ck_' . wc_rand_hash();
    $consumer_secret = 'cs_' . wc_rand_hash();

    $wpdb->insert(
        $wpdb->prefix . 'woocommerce_api_keys',
        array(
            'user_id' => $user->ID,
            'description' => $description,
            'permissions' => $permissions,
            'consumer_key' => wc_api_hash($consumer_key),
            'consumer_secret' => $consumer_secret,
            'truncated_key' => substr($consumer_key, -7),
        ),
        array(
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
        )
    );

    return array(
        'key_id' => $wpdb->insert_id,
        'consumer_key' => $consumer_key,
        'consumer_secret' => $consumer_secret,
        'key_permissions' => $permissions,
    );
}
