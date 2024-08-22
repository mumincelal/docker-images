<?php
class EsSliderController
{
    protected string $tenantUrl = '';


    public function getAllSliders()
    {
        $sliders = $this->httpService('/tenant/es-sliders-wordpress/get-all');

        return $sliders;
    }

    public function getById(string $id)
    {
        $slider = $this->httpService('/tenant/es-sliders-wordpress/show/' . $id);

        return $slider;
    }

    public function getRender(string $id)
    {
        $slider = $this->httpService('/tenant/es-sliders-wordpress/render/' . $id);

        return $slider['data']['views'];
    }

    public function render($uuid)
    {
        $slider = $this->getRender($uuid);
        return $slider;
    }

    private function getTenantUrl(): void
    {
        $response = wp_remote_request('https://easey-api.test/web/wordpress/app-secret-key-to-tenant', [
            'method' => 'POST',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode(['app_secret_key' => get_option('easey_api_key')]),
        ]);

        $this->tenantUrl = "https://" . json_decode(wp_remote_retrieve_body($response), true)['data']['url'];

    }

    private function httpService(string $url, array $body = [], string $method = 'GET')
    {
        $this->getTenantUrl();

        $url = $this->tenantUrl . $url;
        $params = [];
        $params['headers'] = [
            'Content-Type' => 'application/json',
            'APP-SECRET-KEY' => get_option('easey_api_key'),
        ];
        $params['method'] = $method;
        if (!empty($body)) {
            $params['body'] = json_encode($body);
        }
        $response = wp_remote_request($url, $params);


        return json_decode(wp_remote_retrieve_body($response), true);
    }

    private function setSwipperJsAssets()
    {
        wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '11.0.7', true);
        wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), '11.0.7', 'all');
    }

}
