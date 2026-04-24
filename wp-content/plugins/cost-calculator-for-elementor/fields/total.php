<?php
namespace ElementorPro\Modules\Forms\Fields;
use Elementor\Widget_Base;
use ElementorPro\Modules\Forms\Classes;
use Elementor\Controls_Manager;
use ElementorPro\Plugin;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Yeeaddons_Cost_Calculator extends Field_Base {
	public function get_type() {
		return 'calculator';
	}
	public function get_name() {
		return esc_html__( 'Calculator', 'cost-calculator-for-elementor' );
	}
	public function __construct() {
		parent::__construct();
		add_action( 'elementor/preview/init', array( $this, 'editor_preview_footer' ) );
	}
	public function editor_preview_footer() {
		add_action( 'wp_footer', array($this,"field_template_script"));
	}
	function field_template_script(){
	    ?>
	    <script>
	    jQuery( document ).ready( () => {
	         elementor.hooks.addFilter(
                'elementor_pro/forms/content_template/field/calculator',
                function ( inputField, item, i ) {
                    const fieldId    = `form_field_${i}`;
                    const fieldClass = `elementor-field elementor-size-sm elementor-field-textual ${item.css_classes}`;
                    const size       = '1';
                    return `<input  placeholder="Total"  type="text" id="${fieldId}" class="${fieldClass}">`;
                }, 10, 3
            );
	    });
	    </script>
	    <?php
	}
	public function render( $item, $item_index, $form ) {
		$form->remove_render_attribute( 'input' . $item_index, 'type' );
		$form->add_render_attribute( 'input' . $item_index, 'type', 'text' );
		$form->add_render_attribute( 'input' . $item_index, 'readonly', 'readonly' );
		$form->add_render_attribute( 'input' . $item_index, 'class', 'elementor-field-textual elementor-field-calculator' );
		if ( isset( $item['formula'] ) ) {
			$form->add_render_attribute( 'input' . $item_index, 'data-formula', esc_attr( $item['formula'] ) );
		}
		if ( isset( $item['number_format'] ) && $item['number_format'] =="yes" ) {
			$form->add_render_attribute( 'input' . $item_index, 'class', 'elementor-number-format' );
			$number_format_symbols = (isset($item['number_format_symbols'] ))? esc_attr( $item['number_format_symbols'] ) : "";
			$number_format_decimal_sep = (isset($item['number_format_decimal_sep'] ))? esc_attr( $item['number_format_decimal_sep'] ) : ".";
			$number_format_thousand_sep = (isset($item['number_format_thousand_sep'] ))? esc_attr( $item['number_format_thousand_sep'] ) : ",";
			$number_format_num_decimals = (isset($item['number_format_num_decimals'] ))? esc_attr( $item['number_format_num_decimals'] ) : "2";
			$form->add_render_attribute( 'input' . $item_index, 'data-a-sign', $number_format_symbols );
			$form->add_render_attribute( 'input' . $item_index, 'data-a-dec', $number_format_decimal_sep );
			$form->add_render_attribute( 'input' . $item_index, 'data-a-sep', $number_format_thousand_sep );
			$form->add_render_attribute( 'input' . $item_index, 'data-m-dec', $number_format_num_decimals );
			if( isset($item['number_format_symbols_position']) && $item['number_format_symbols_position'] == "right" ){
				$form->add_render_attribute( 'input' . $item_index, 'data-p-sign', 's');
			}
		}
		?>
			<input <?php $form->print_render_attribute_string( 'input' . $item_index ); ?> >
		<?php
	}
	/**
	 * @param Widget_Base $widget
	 */
	public function update_controls( $widget ) {
		$elementor = Plugin::elementor();
		$control_data = $elementor->controls_manager->get_control_from_stack( $widget->get_unique_name(), 'form_fields' );
		if ( is_wp_error( $control_data ) ) {
			return;
		}
		$field_controls = [
				'formula' => [
					'name' => 'formula',
					'label' => esc_html__( 'Formula', 'cost-calculator-for-elementor' ),
					'type' => Controls_Manager::TEXTAREA,
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format' => [
					'name' => 'number_format',
					'label' => esc_html__( 'Number Format', 'cost-calculator-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_symbols' => [
					'name' => 'number_format_symbols',
					'label' => esc_html__( 'Symbols', 'cost-calculator-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'field_type' => $this->get_type(),
						'number_format' => 'yes'
					],
					'dynamic' => [
						'active' => true,
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_symbols_position' => [
					'name' => 'number_format_symbols_position',
					'label' => esc_html__( 'Symbols Position', 'drag-and-drop-file-upload-for-elementor-forms' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Default: Left ( Upgrade to pro to change it )', 'repeater-for-elementor' ),
					'condition' => [
						'field_type' => $this->get_type(),
						'number_format' => 'yes'
					],
					'description' => esc_html__( "Symbols format", 'drag-and-drop-file-upload-for-elementor-forms' ),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_thousand_sep' => [
					'name' => 'number_format_thousand_sep',
					'label' => esc_html__( 'Thousand separator', 'drag-and-drop-file-upload-for-elementor-forms' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Default: , ( Upgrade to pro to change it )', 'repeater-for-elementor' ),
					'condition' => [
						'field_type' => $this->get_type(),
						'number_format' => 'yes'
					],
					'description' => esc_html__( "Thousand separator", 'drag-and-drop-file-upload-for-elementor-forms' ),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_decimal_sep' => [
					'name' => 'number_format_decimal_sep',
					'label' => esc_html__( 'Decimal separator', 'drag-and-drop-file-upload-for-elementor-forms' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Default: . ( Upgrade to pro to change it )', 'repeater-for-elementor' ),
					'condition' => [
						'field_type' => $this->get_type(),
						'number_format' => 'yes'
					],
					'description' => esc_html__( "Decimal separator", 'drag-and-drop-file-upload-for-elementor-forms' ),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_num_decimals' => [
					'name' => 'number_format_num_decimals',
					'label' => esc_html__( 'Number Decimals', 'drag-and-drop-file-upload-for-elementor-forms' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Default: 2 ( Upgrade to pro to change it )', 'repeater-for-elementor' ),
					'condition' => [
						'field_type' => $this->get_type(),
						'number_format' => 'yes'
					],
					'description' => esc_html__( "Number Decimals", 'drag-and-drop-file-upload-for-elementor-forms' ),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
			];
		$control_data['fields'] = $this->inject_field_controls( $control_data['fields'], $field_controls );
		$widget->update_control( 'form_fields', $control_data );
	}
}
new Yeeaddons_Cost_Calculator;