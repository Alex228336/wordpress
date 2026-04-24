<?php
namespace ElementorPro\Modules\Forms\Fields;
use Elementor\Widget_Base;
use ElementorPro\Modules\Forms\Classes;
use Elementor\Controls_Manager;
use ElementorPro\Plugin;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Number_Format_Cost_Calculator extends Field_Base {
	public function get_type() {
		return 'number_format';
	}
	public function get_name() {
		return esc_html__( 'Number Format', 'cost-calculator-for-elementor' );
	}
	public function editor_preview_footer() {
		add_action( 'wp_footer', array($this,"field_template_script"));
	}
	public function __construct() {
		parent::__construct();
		add_action( 'elementor/preview/init', array( $this, 'editor_preview_footer' ) );
	}
	function field_template_script(){
	    ?>
	    <script>
	    jQuery( document ).ready( () => {
	        elementor.hooks.addFilter(
                'elementor_pro/forms/content_template/field/number_format',
                function ( inputField, item, i ) {
                    const fieldId    = `form_field_${i}`;
                    const fieldClass = `elementor-field elementor-size-sm elementor-field-textual ${item.css_classes}`;
                    const size       = '1';
                    return `<input placeholder="Number Format" type="text" id="${fieldId}" class="${fieldClass}">`;
                }, 10, 3
            );
	    });
	    </script>
	    <?php
	}
	public function render( $item, $item_index, $form ) {
		$form->remove_render_attribute( 'input' . $item_index, 'type' );
		$form->add_render_attribute( 'input' . $item_index, 'type', 'text' );
		if ( isset( $item['field_min'] ) ) {
			$form->add_render_attribute( 'input' . $item_index, 'min', esc_attr( $item['field_min'] ) );
		}
		if ( isset( $item['field_max'] ) ) {
			$form->add_render_attribute( 'input' . $item_index, 'max', esc_attr( $item['field_max'] ) );
		}
		$number_format_symbols = (isset($item['number_format_symbols1'] ))? esc_attr( $item['number_format_symbols1'] ) : "";
		$number_format_decimal_sep = (isset($item['number_format_decimal_sep1'] ))? esc_attr( $item['number_format_decimal_sep1'] ) : ".";
		$number_format_thousand_sep = (isset($item['number_format_thousand_sep1'] ))? esc_attr( $item['number_format_thousand_sep1'] ) : ",";
		$number_format_num_decimals = (isset($item['number_format_num_decimals1'] ))? esc_attr( $item['number_format_num_decimals1'] ) : "2";
		$form->add_render_attribute( 'input' . $item_index, 'class', 'elementor-field-textual elementor-number-format' );
		$form->add_render_attribute( 'input' . $item_index, 'data-a-sign', esc_attr( $number_format_symbols ) );
		$form->add_render_attribute( 'input' . $item_index, 'data-a-dec', esc_attr( $number_format_decimal_sep ) );
		$form->add_render_attribute( 'input' . $item_index, 'data-a-sep', esc_attr( $number_format_thousand_sep ) );
		$form->add_render_attribute( 'input' . $item_index, 'data-m-dec', esc_attr( $number_format_num_decimals) );
		if( isset($item['number_format_symbols_position1'] ) && $item['number_format_symbols_position1'] == "right" ){
			$form->add_render_attribute( 'input' . $item_index, 'data-p-sign', 's');
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
				'field_min1' => [
					'name' => 'field_min1',
					'label' => esc_html__( 'Min. Value', 'cost-calculator-for-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'field_max1' => [
					'name' => 'field_max1',
					'label' => esc_html__( 'Max. Value', 'cost-calculator-for-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_symbols1' => [
					'name' => 'number_format_symbols1',
					'label' => esc_html__( 'Symbols', 'cost-calculator-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_symbols_position1' => [
					'name' => 'number_format_symbols_position1',
					'label' => esc_html__( 'Symbols Position', 'drag-and-drop-file-upload-for-elementor-forms' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Default: Left ( Upgrade to pro to change it )', 'repeater-for-elementor' ),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( "Symbols format", 'drag-and-drop-file-upload-for-elementor-forms' ),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_thousand_sep1' => [
					'name' => 'number_format_thousand_sep1',
					'label' => esc_html__( 'Thousand separator', 'drag-and-drop-file-upload-for-elementor-forms' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Default: , ( Upgrade to pro to change it )', 'repeater-for-elementor' ),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( "Thousand separator", 'drag-and-drop-file-upload-for-elementor-forms' ),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_decimal_sep1' => [
					'name' => 'number_format_decimal_sep1',
					'label' => esc_html__( 'Decimal separator', 'drag-and-drop-file-upload-for-elementor-forms' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Default: . ( Upgrade to pro to change it )', 'repeater-for-elementor' ),
					'condition' => [
						'field_type' => $this->get_type(),
					],
					'description' => esc_html__( "Decimal separator", 'drag-and-drop-file-upload-for-elementor-forms' ),
					'tab' => 'content',
					'inner_tab' => 'form_fields_content_tab',
					'tabs_wrapper' => 'form_fields_tabs',
				],
				'number_format_num_decimals1' => [
					'name' => 'number_format_num_decimals1',
					'label' => esc_html__( 'Number Decimals', 'drag-and-drop-file-upload-for-elementor-forms' ),
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'pro_disable elementor-panel-alert elementor-panel-alert-info',
					'raw' => esc_html__( 'Default: 2 ( Upgrade to pro to change it )', 'repeater-for-elementor' ),
					'condition' => [
						'field_type' => $this->get_type(),
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
	public function validation( $field, Classes\Form_Record $record, Classes\Ajax_Handler $ajax_handler ) {
		if ( ! empty( $field['field_max'] ) && $field['field_max'] < (int) $field['value'] ) {
			$ajax_handler->add_error( $field['id'], sprintf( esc_html__( 'The value must be less than or equal to %s', 'cost-calculator-for-elementor' ), $field['field_max'] ) );
		}
		if ( ! empty( $field['field_min'] ) && $field['field_min'] > (int) $field['value'] ) {
			$ajax_handler->add_error( $field['id'], sprintf( esc_html__( 'The value must be greater than or equal %s', 'cost-calculator-for-elementor' ), $field['field_min'] ) );
		}
	}
}
new Number_Format_Cost_Calculator;