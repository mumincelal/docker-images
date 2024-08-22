<?php


function revolutionSliderStore($request)
{
    global $wpdb;

    // İstekten parametreleri alma
    $title = $request['title'];
    $alias = $request['alias'];
    $params = json_encode($request['params']);
    $settings = '{"version":"6.6.13"}';

    // Revolution Slider tablosuna veri ekleme
    $wpdb->insert(
        $wpdb->prefix . 'revslider_sliders', // Revolution Slider tablosu
        array(
            'title' => $title,
            'alias' => $alias,
            'params' => $params,
            'settings' => $settings,
            'type' => "",
        ),
        array(
            '%s',
            '%s',
            '%s',
            '%s',
        )
    );

    // Ekleme işleminin başarılı olup olmadığını kontrol etme
    if ($wpdb->last_error) {
        return new WP_Error('slider_creation_failed', esc_html__('Failed to create slider.', 'text-domain'), array('status' => 500));
    } else {
        $slider_id = $wpdb->insert_id;
        return array(
            'success' => true,
            'message' => 'Slider başarıyla oluşturuldu.',
            'remote_id' => $slider_id
        );
    }
}

function revolutionSlideStore($request)
{
    $post_data = json_decode(file_get_contents("php://input"), true);
    global $wpdb;

    foreach ($post_data as $item) {
        // İstekten parametreleri alma
        $slider_id = $item['slider_id'];
        $slide_order = $item['slide_order'];
        $params = json_encode($item['params']);
        $layers = $item['layers'];
        $settings = '{"version":"6.6.13"}';

        // Revolution Slider tablosuna veri ekleme
        $wpdb->insert(
            $wpdb->prefix . 'revslider_slides', // Revolution Slider tablosu
            array(
                'slider_id' => $slider_id,
                'slide_order' => $slide_order,
                'params' => $params,
                'layers' => $layers,
                'settings' => $settings,
            ),
            array(
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
            )
        );
    }


    // Ekleme işleminin başarılı olup olmadığını kontrol etme
    if ($wpdb->last_error) {
        return new WP_Error('slider_creation_failed', esc_html__('Failed to create slider.', 'text-domain'), array('status' => 500));
    } else {
        return array(
            'success' => true,
            'message' => 'Slide başarıyla oluşturuldu.'
        );
    }
}

function revolutionSliderUpdate($request)
{
    $post_data = json_decode(file_get_contents("php://input"), true);
    global $wpdb;

    $slider_id = $post_data['remote_id'];
    $title = $post_data['title'];
    $alias = $post_data['alias'];
    $params = json_encode($post_data['params']);

    $wpdb->update(
        $wpdb->prefix . 'revslider_sliders',
        array(
            'title' => $title,
            'alias' => $alias,
            'params' => $params,
        ),
        array('id' => $slider_id),
        array(
            '%s',
            '%s',
            '%s',
        ),
        array('%d')
    );

    $wpdb->delete(
        $wpdb->prefix . 'revslider_slides',
        array('slider_id' => $slider_id),
        array('%d')
    );

    foreach ($post_data['slides'] as $item) {
        $slider_id = $item['slider_id'];
        $slide_order = $item['slide_order'];
        $params = json_encode($item['params']);
        $layers = $item['layers'];
        $settings = '{"version":"6.6.13"}';

        // Revolution Slider tablosuna veri ekleme
        $wpdb->insert(
            $wpdb->prefix . 'revslider_slides', // Revolution Slider tablosu
            array(
                'slider_id' => $slider_id,
                'slide_order' => $slide_order,
                'params' => $params,
                'layers' => $layers,
                'settings' => $settings,
            ),
            array(
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
            )
        );
    }

    if ($wpdb->last_error) {
        return new WP_Error('slider_update_failed', esc_html__('Failed to update slider.', 'text-domain'), array('status' => 500));
    } else {
        return array(
            'success' => true,
            'message' => 'Slider başarıyla güncellendi.'
        );
    }
}

function revolutionSliderSync()
{
    global $wpdb;

    $sliders = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "revslider_sliders");

    $data = [];
    foreach ($sliders as $slider) {
        $slides = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "revslider_slides WHERE slider_id = " . $slider->id);
        $data[] = [
            'slider' => $slider,
            'slides' => $slides
        ];
    }

    return $data;
}
