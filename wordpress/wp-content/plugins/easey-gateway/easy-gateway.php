<?php

/**
 * Plugin Name: Easey AI
 * Plugin URI: https://easey.ai/
 * Description: A next-gen content management system that empowers WordPress users with headless architecture for unparalleled flexibility and control over their web content.
 * Version: 1.0
 * Author: Easey AI
 * Author URI: https://easey.ai/
 * License: GPL2
 */


#Include Area

require_once ABSPATH . 'wp-content/plugins/easey-gateway/src/router.php';

require_once ABSPATH . 'wp-content/plugins/easey-gateway/src/PageManager.php';

require_once ABSPATH . 'wp-content/plugins/easey-gateway/src/WoocommerceManager.php';

require_once ABSPATH . 'wp-content/plugins/easey-gateway/src/ElementorManager.php';

require_once ABSPATH . 'wp-content/plugins/easey-gateway/src/SystemManager.php';

require_once ABSPATH . 'wp-content/plugins/easey-gateway/src/RevolutionSliderManager.php';

require_once ABSPATH . 'wp-content/plugins/easey-gateway/EaseySlider/EsSliderController.php';



#Function Area
function api_key_set_page()
{
?>
    <script src="https://cdn.tailwindcss.com"></script>
    <form method="post" action="options.php" class="py-8 pl-4 pr-8 space-y-8">
        <div class="border px-12 flex gap-5 items-center align-middle mx-auto bg-white rounded-lg justify-between ">
            <div class="flex gap-5 align-middle items-center">
                <img src="https://www.easey.ai/h-1@2x.png" width="150" class="py-5" />
                <!-- <ul class="flex gap-3 text-slate-600 font-light mt-1">
                    <li
                        class="border-b-2 border-transparent hover:border-blue-500 py-4 px-2 transition font-medium"
                    >
                        <a href=""> Welcome </a>
                    </li>
                </ul> -->
            </div>
            <div class="flex items-center gap-3 align-middle">

                <button type="submit" class="bg-[#3577BD] font-medium flex items-center align-middle gap-2 border border-color-[#215c9a] px-4 py-2 rounded-[0.5rem] text-white mt-2 hover:bg-[#215C9B] transition">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z" />
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    Save changes</button>
                <button disabled class="bg-[#F0F7FF] flex items-center align-middle gap-2 px-4 py-2 rounded-xl text-[#215c9a] mt-2 hover:bg-[#CEE5FF] transition font-medium">
                    <svg class="w-6 h-6 text-[#215c9a]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4" />
                    </svg>
                    Sync website</button>
            </div>
            <!-- <?php submit_button(); ?> -->
        </div>
        <div class="py-8 grid grid-cols-2 gap-5 mx-auto ">
            <div class=" flex flex-col items-start p-10 border gap-2 px-8 py-16  bg-white shadow-lg rounded-lg shadow-slate-500/10">
                <p class="text-2xl text-slate-800 mb-1">
                    Welcome to Easey AI
                </p>

                <p class="flex-grow-0 flex-shrink-0 text-base text-left text-[#667085] mb-5">
                    Overflowing with useful features, Easey offers an intuitive headless CMS, the ability to effortlessly manage multiple WordPress sites, simplified order management, and seamless data transfer using our headless API.

                </p>
                <h2 class="flex-grow-0 flex-shrink-0 text-sm font-medium text-left text-[#344054]">Enter your API key</h2>
                <input type="text" name="easey_api_key" value="<?php echo esc_attr(get_option('easey_api_key')); ?>" class="block w-[500px] rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-[#F0F7FF] placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#CEE4FE] sm:text-sm sm:leading-6">
                <?php settings_fields('easey_api_key_settings'); ?>
                <div class="flex items-center gap-3 align-middle">
                    <button type="submit" class="bg-[#3577BD] font-medium flex items-center align-middle gap-2 border border-color-[#215c9a] px-4 py-2 rounded-[0.5rem] text-white mt-2 hover:bg-[#215C9B] transition">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h11.586a1 1 0 0 1 .707.293l2.414 2.414a1 1 0 0 1 .293.707V19a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Z" />
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 4h8v4H8V4Zm7 10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        Save changes</button>
                </div>
            </div>
            <div class=" flex flex-col items-start p-10 border gap-2 px-8 py-16  bg-white shadow-lg rounded-lg shadow-slate-500/10">
                <h2 class="text-2xl text-slate-800 mb-1">How to sync your website?</h2>
                <p class="flex-grow-0 flex-shrink-0 text-base text-left text-[#667085] mb-5">
                    Watch the video to learn more about syncing your website.</p>
                <iframe height="300" src="https://www.youtube.com/embed/u31qwQUeGuM?si=glFE7vM0Mxf2pFYM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="rounded w-full"></iframe>
            </div>
        </div>
    </form>
<?php
}

function easey_api_plugin_settings()
{
    register_setting('easey_api_key_settings', 'easey_api_key');
}

function easey_api_plugin_menu()
{
    add_options_page('Easey AI', 'Easey AI', 'manage_options', 'easey-api-plugin', 'api_key_set_page');
}

function verification_token()
{
    $post_data = json_decode(file_get_contents("php://input"), true);
    $app_secret_key = $post_data['app_secret_key'];

    $stored_api_key = get_option('easey_api_key');
    if (is_null($stored_api_key) && empty($stored_api_key)) {
        return [
            'status' => false,
            'message' => 'API anahtarı bulunamadı.'
        ];
    }

    if ($app_secret_key === $stored_api_key) {
        return [
            'status' => true,
            'message' => 'API anahtarı doğrulandı.'
        ];
    }

    return [
        'status' => false,
        'message' => 'API anahtarı doğrulanamadı.'
    ];
}

function easey_api_key_check_middleware()
{
    $api_key = isset($_SERVER['HTTP_API_KEY']) ? $_SERVER['HTTP_API_KEY'] : '';
    $stored_api_key = get_option('easey_api_key');

    // Anahtar doğrulaması yap
    if ($api_key !== $stored_api_key) {
        // Anahtar doğru değilse HTTP 401 hatası döndür
        return new WP_Error('unauthorized', 'API anahtarı doğrulanamadı.', array('status' => 401));
    }

    return true;
}

#Function Area End

function registerEsSliderWidget($widgets_manager)
{

    require_once ABSPATH . 'wp-content/plugins/easey-gateway/EaseySlider/ElementorWidget/EsSliderWidget.php';
    $widgets_manager->register(new \EsSliderWidget());
}

function testing()
{
    $controller = new EsSliderController();
    $test = $controller->render('9b9a1100-951a-49a6-b3fb-f647b5c13996');
    return $test;
}



function es_slider_short_code($atts)
{
    // UUID'yi shortcode özelliği olarak belirtme
    $atts = shortcode_atts(
        array(
            'uuid' => '',
        ),
        $atts,
        'es_slider'
    );
    $uuid = $atts['uuid'];
    $controller = new EsSliderController();
    return $controller->render($uuid);
}

add_shortcode('es_slider', 'custom_slider_shortcode');
add_action('elementor/widgets/register', 'registerEsSliderWidget');
add_action('admin_menu', 'easey_api_plugin_menu');
add_action('admin_init', 'easey_api_plugin_settings');
