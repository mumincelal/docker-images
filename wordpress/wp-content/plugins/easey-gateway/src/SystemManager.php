<?php
function getSiteUrl()
{

    $settings = [
        'siteurl' => get_option('siteurl'),
    ];

    return $settings;
}

function getAllPlugins(): array
{
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
    $plugins = get_plugins();
    $returnData = [];
    foreach ($plugins as $plugin) {
        if ($plugin['Name'] != 'Easy Gateway') {
            $returnData[] = $plugin;
        }
    }
    return $returnData;
}
