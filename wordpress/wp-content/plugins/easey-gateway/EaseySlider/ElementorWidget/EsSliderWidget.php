<?php
use Elementor\Widget_Base;


class EsSliderWidget extends Widget_Base {

    public function get_name():string {
        return 'es-slider-widget';
    }

    public function get_title(): string {
        return __( 'Es Slider Widget', 'easey-slider' );
    }

    public function get_icon(): string {
        return 'eicon-slider-3d';
    }

    public function get_categories(): array {
        return [ 'general' ];
    }

    protected function render()
    {
        if (empty($this->get_settings_for_display('slider_id'))) {
            return;
        }
        $controller = new EsSliderController();
        $get_html = (string) $controller->render($this->get_settings_for_display('slider_id'));
        ?>
        <div id="EsSliders">
            <?php echo $get_html; ?>
        </div>
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


        $controller = new EsSliderController();
        $sliders = $controller->getAllSliders();
        $options = [];
        $options[''] = 'Lütfen Seçin';
        foreach ($sliders['data'] as $slider) {
            $options[$slider['id']] = $slider['title'];
        }


        $this->add_control(
            'slider_id',
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
