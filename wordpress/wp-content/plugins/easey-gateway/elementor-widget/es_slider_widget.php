<?php
use Elementor\Widget_Base;

class Es_Slider_Widget extends Widget_Base {



    public function get_name() {
        return 'es-slider-widget';
    }

    public function get_title() {
        return __( 'Es Slider Widget', 'easey-slider' );
    }

    public function get_icon(): string {
        return 'eicon-slider-3d';
    }

    public function get_categories(): array {
        return [ 'general' ];
    }

    protected function render() {
        if (empty($this->get_settings_for_display('slider_url'))) {
            return;
        }
        ?>
        <iframe src="<?php echo $this->get_settings_for_display('slider_url') ?>" id="EsSliders" frameborder="0" scrolling="no"></iframe>
        <?php
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                console.log("EsSlider Widget Loaded")
                var iframe = $('#EsSliders');
                console.log("iframe", iframe);
                iframe.on('load', function() {
                    console.log("EsSlider Widget Loaded Two")
                    var iframeContents = iframe.contents();
                    console.log("sss", iframeContents.html());
                   // iframe.height(height);
                });
            });
        </script>
        <?php
    }

    protected function _register_controls() {
        $this->start_controls_section(
                'content_section',
                [
                        'label' => esc_html__( 'Genel Ayarlar', 'textdomain' ),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
        );
        $url = 'https://mscbalik-test.easey-api.test/tenant/es-sliders-wordpress/get-all';

        $response = wp_remote_get( $url );
        $options = [];
        $options[''] = 'Lütfen Seçin';
        foreach (json_decode(wp_remote_retrieve_body($response))->data as $slider) {
            $options[$slider->render_url] = $slider->title;
        }
        $this->add_control(
                'slider_url',
                [
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'label' => esc_html__( 'Slider Seçin', 'textdomain' ),
                        'options' => $options,
                        'default' => '',
                ]
        );


        $this->end_controls_section();
    }



}
