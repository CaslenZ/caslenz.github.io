<?php
//底部设置
if (!class_exists('Reli_Seting_Footer')) {
    class Reli_Seting_Footer
    {
        public static function run()
        {
            add_action('customize_register', array(__CLASS__, 'footer'));
        }
        /**
         * 添加设置
         */
        public static function footer($wp_customize)
        {
            //拿到默认值
            $footer = Reli_Seting_Default::run("footer");

            //底部 添加描述

            $wp_customize->add_setting(
                'footer_meat',
                array(
                    'default' => $footer['meat'],
                    'transport' => 'refresh',
                    'sanitize_callback' => 'wp_kses_post'
                )
            );

            $wp_customize->add_control(
                'footer_meat',
                array(
                    'label' => __('底部文本'),
                    'description' => esc_html__('输入的内容展示在底部'),
                    'section' => 'redline_footer',
                    'priority' => 10, // 可选择的排序优先级以加载控件。默认值：10
                    'type' => 'textarea', // Can be either text, email, url, number, hidden, or date
                    'capability' => 'edit_theme_options', // 可选择的默认值：'edit_theme_options'
                    'input_attrs' => array( // Optional.
                        'class' => 'my-custom-class',
                        'style' => 'border: 1px solid #999',
                        'placeholder' => __('输入...'),
                    ),
                )
            );
        }
    }
}
