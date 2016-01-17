<?php

if (! defined('ABSPATH')) {
    exit;
}

class Cuztom_Field_Multi_Select extends Cuztom_Field
{
    /**
     * Feature support
     */
    public $_supports_bundle        = true;

    /**
     * Attributes
     */
    public $css_classes            = array( 'cuztom-input', 'cuztom-select', 'cuztom-multi-select' );

    /**
     * Constructs Cuztom_Field_Multi_Select
     *
     * @author 	Gijs Jorissen
     * @since 	0.3.3
     *
     */
    public function __construct($field)
    {
        parent::__construct($field);

        $this->default_value    = (array) $this->default_value;
        $this->after           .= '[]';
    }

    /**
     * Output method
     *
     * @return  string
     *
     * @author 	Gijs Jorissen
     * @since 	2.4
     *
     */
    public function _output($value = null)
    {
        $output = '<select ' . $this->output_name() . ' ' . $this->output_id() . ' ' . $this->output_css_class() . ' multiple="true">';
        if (isset($this->args['show_option_none'])) {
            $output .= '<option value="0" ' . (is_array($value) ? (in_array(0, $value) ? 'selected="selected"' : '') : (($value == '-1') ? '' : in_array(0, $this->default_value) ? 'selected="selected"' : '')) . '>' . $this->args['show_option_none'] . '</option>';
        }

        if (is_array($this->options)) {
            foreach ($this->options as $slug => $name) {
                $output .= '<option value="' . $slug . '" ' . (is_array($value) ? (in_array($slug, $value) ? 'selected="selected"' : '') : (($value == '-1') ? '' : in_array($slug, $this->default_value) ? 'selected="selected"' : '')) . '>' . Cuztom::beautify($name) . '</option>';
            }
        }
        $output .= '</select>';
        $output .= $this->output_explanation();

        return $output;
    }

    /**
     * Parse value
     *
     * @param 	string 		$value
     *
     * @author  Gijs Jorissen
     * @since 	2.8
     *
     */
    public function parse_value($value)
    {
        return empty($value) ? '-1' : $value;
    }
}
