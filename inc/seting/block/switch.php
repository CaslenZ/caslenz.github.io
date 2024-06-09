<?php
//按钮控件
/**
 * Switch sanitization
 *
 * @param  string		Switch value
 * @return integer	Sanitized value
 */
if (!function_exists('skyrocket_switch_sanitization_a')) {
    function skyrocket_switch_sanitization_a($input)
    {
        if (true == $input) {
            return "true";
        } else {
            return "false";
        }
    }
}

/**
 * Toggle Switch Custom Control
 *
 * @author Anthony Hortin <http://maddisondesigns.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @link https://github.com/maddisondesigns
 */
class Skyrocket_Toggle_Switch_Custom_control_a extends WP_Customize_Control
{
    /**
     * The type of control being rendered
     */
    public $type = 'toggle_switch_a';
    /**
     * Enqueue our scripts and styles
     */
    public function enqueue()
    {
        //wp_enqueue_style( 'skyrocket-custom-controls-css', plugin_dir_url( __DIR__ )  . 'public/css/customizer.css', array(), '1.0', 'all' );
    }
    /**
     * Render the control in the customizer
     */
    public function render_content()
    {
?>
        <div class="toggle-switch-control">
            <div class="toggle-switch">
                <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link();
                                                                                                                                                                                                            checked($this->value()); ?>>
                <label class="toggle-switch-label" for="<?php echo esc_attr($this->id); ?>">
                    <span class="toggle-switch-inner"></span>
                    <span class="toggle-switch-switch"></span>
                </label>
            </div>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if (!empty($this->description)) { ?>
                <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php } ?>
        </div>
        <style>
            /* ==========================================================================
   Toggle Switch
   ========================================================================== */
            .toggle-switch-control .customize-control-title {
                display: inline-block;
            }

            .toggle-switch {
                position: relative;
                width: 64px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                float: right;
            }

            .toggle-switch .toggle-switch-checkbox {
                display: none;
            }

            .toggle-switch .toggle-switch-label {
                display: block;
                overflow: hidden;
                cursor: pointer;
                border: 2px solid #ddd;
                border-radius: 20px;
                padding: 0;
                margin: 0;
            }

            .toggle-switch-inner {
                display: block;
                width: 200%;
                margin-left: -100%;
                transition: margin 0.3s ease-in 0s;
            }

            .toggle-switch-inner:before,
            .toggle-switch-inner:after {
                display: block;
                float: left;
                width: 50%;
                height: 22px;
                padding: 0;
                line-height: 22px;
                font-size: 14px;
                color: white;
                font-family: Trebuchet, Arial, sans-serif;
                font-weight: bold;
                box-sizing: border-box;
            }

            .toggle-switch-inner:before {
                content: "开";
                padding-left: 8px;
                background-color: #2885bb;
                color: #FFFFFF;
            }

            .toggle-switch-inner:after {
                content: "关";
                padding-right: 8px;
                background-color: #eeeeee;
                color: #999999;
                text-align: right;
            }

            .toggle-switch-switch {
                display: block;
                width: 16px;
                margin: 3px;
                background-color: #ffffff;
                position: absolute;
                top: 0;
                bottom: 0;
                right: 38px;
                border: 2px solid #ddd;
                border-radius: 20px;
                transition: all 0.3s ease-in 0s;
            }

            .toggle-switch-checkbox:checked+.toggle-switch-label .toggle-switch-inner {
                margin-left: 0;
            }

            .toggle-switch-checkbox:checked+.toggle-switch-label .toggle-switch-switch {
                right: 0px;
            }
        </style>
<?php
    }
}
