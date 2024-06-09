<?php
//顶部设置
if (!class_exists('Reli_Seting_Header')) {
    class Reli_Seting_Header
    {
        public static function run()
        {
            add_action('customize_register',  array(__CLASS__, 'header'));
        }
        public static function header($wp_customize)
        {
            //在此处添加所有自定义器内容（即面板、节、设置和控件）。。。
            $wp_customize->add_panel(
                'red_line_panel',
                array(
                    'title' => __('RedLine 设置'),
                    'description' => esc_html__('控制主题细节的方方面面'), // Include html tags such as 

                    'priority' => 160, // Not typically needed. Default is 160
                    'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
                    'theme_supports' => '', // Rarely needed
                    'active_callback' => '', // Rarely needed
                )
            );

            //添加节 - 顶部
            $wp_customize->add_section(
                'redline_header',
                array(
                    'title' => __('顶部'),
                    'description' => esc_html__('控制页面顶部内容'),
                    'panel' => 'red_line_panel', // Only needed if adding your Section to a Panel
                    'priority' => 160, // Not typically needed. Default is 160
                    'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
                    'theme_supports' => '', // Rarely needed
                    'active_callback' => '', // Rarely needed
                    'description_hidden' => 'false', // Rarely needed. Default is False
                )
            );


            //添加节 - 首页
            $wp_customize->add_section(
                'redline_home',
                array(
                    'title' => __('首页'),
                    'description' => esc_html__('控制首次展开的内容'),
                    'panel' => 'red_line_panel', // Only needed if adding your Section to a Panel
                    'priority' => 170, // Not typically needed. Default is 160
                    'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
                    'theme_supports' => '', // Rarely needed
                    'active_callback' => '', // Rarely needed
                    'description_hidden' => 'false', // Rarely needed. Default is False
                )
            );

            //添加节 - 底部
            $wp_customize->add_section(
                'redline_footer',
                array(
                    'title' => __('底部'),
                    'description' => esc_html__('控制底部展示内容'),
                    'panel' => 'red_line_panel', // Only needed if adding your Section to a Panel
                    'priority' => 180, // Not typically needed. Default is 160
                    'capability' => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
                    'theme_supports' => '', // Rarely needed
                    'active_callback' => '', // Rarely needed
                    'description_hidden' => 'false', // Rarely needed. Default is False
                )
            );

            //拿到默认值
            $header =Reli_Seting_Default::run("header");

            //顶部 - 添加LOGO
            $wp_customize->add_setting(
                'header_logo',
                array(
                    'default' => $header['logo'],
                    'transport' => 'refresh',
                    'sanitize_callback' => 'esc_url_raw'
                )
            );

            $wp_customize->add_control(new WP_Customize_Image_Control(
                $wp_customize,
                'header_logo',
                array(
                    'label' => __('选择LOGO'),
                    'description' => esc_html__('此图像出现在页面上方，高度90像素，宽度不限'),
                    'section' => 'redline_header',
                    'button_labels' => array( // Optional.
                        'select' => __('选择图像'),
                        'change' => __('更改图像'),
                        'remove' => __('移除'),
                        'default' => __('Default'),
                        'placeholder' => __('未选择图像'),
                        'frame_title' => __('Select Image'),
                        'frame_button' => __('Choose Image'),
                    )
                )
            ));
        }
    }
}
