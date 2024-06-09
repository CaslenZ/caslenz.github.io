<?php
//首页设置
if (!class_exists('Reli_Seting_Home')) {
    class Reli_Seting_Home
    {
        public static function run()
        {
            add_action('customize_register', array(__CLASS__, 'home'));
            //添加JS
            //add_action('customize_controls_print_footer_scripts', array(__CLASS__, 'add_custom_js'));
        }
        public static function home($wp_customize)
        {
            $home = Reli_Seting_Default::run("home");

            //首页 - 是否启用首页
            $wp_customize->add_setting(
                'home_switch',
                array(
                    'default' => $home['switch'],
                    'transport' => 'refresh',
                    'sanitize_callback' => 'sanitize_text_field'
                )
            );

            $wp_customize->add_control(
                'home_switch',
                array(
                    'label' => __('启用首页'),
                    'description' => esc_html__('修改选项并发布后，请回到此页配置详细信息'),
                    'section' => 'redline_home',
                    'priority' => 10,
                    'type' => 'select',
                    'capability' => 'edit_theme_options',
                    'choices' => array(
                        'true' => __('开'),
                        'false' => __('关')

                    )
                )
            );





            //若关闭首页，则隐藏选项
            if (get_theme_mod('home_switch', $home['switch']) === "false") {
                //不启用首页，显示指定ID的内容
               //$wp_customize->add_setting(
               //    'home_show',
               //    array(
               //        'default' =>  $home['show'],
               //        'transport' => 'refresh',
               //        'sanitize_callback' => ''
               //    )
               //);

                //$wp_customize->add_control(
                //    'home_show',
                //    array(
                //        'label' => __('若禁用首页，请输入此选项'),
                //        'description' => esc_html__('请输入一个展示的文章或页面ID'),
                //        'section' => 'redline_home',
                //        'priority' => 10, // 可选择的排序优先级以加载控件。默认值：10
                //        'type' => 'number', // Can be either text, email, url, number, hidden, or date
                //        'capability' => 'edit_theme_options', // 可选择的默认值：'edit_theme_options'
                //        'input_attrs' => array( // Optional.
                //            'class' => 'my-custom-class',
                //            'style' => 'border: 1px solid rebeccapurple',
                //            'placeholder' => __('输入文章或页面ID'),
                //        ),
                //    )
                //);

                $wp_customize->add_setting(
                    'home_show',
                    array(
                        'default' =>  $home['show'],
                        'transport' => 'refresh',
                        'sanitize_callback' => 'absint'
                    )
                );

                $wp_customize->add_control(
                    'home_show',
                    array(
                        'label' => __('选择首页展示的页面'),
                        'description' => esc_html__('请从下方选择'),
                        'section' => 'redline_home',
                        'priority' => 10,
                        'type' => 'dropdown-pages',
                        'capability' => 'edit_theme_options',
                    )
                );

                //end

            } else {





                //首页 - 幻灯片文章
                $wp_customize->add_setting(
                    'home_slid',
                    array(
                        'default' => $home['slid'],
                        'transport' => 'refresh',
                        'sanitize_callback' => 'wp_filter_nohtml_kses'
                    )
                );

                $wp_customize->add_control(
                    'home_slid',
                    array(
                        'label' => __('幻灯片数据'),
                        'description' => esc_html__('请按格式输入，一行一个：图片链接|跳转链接|0或1；  1：跳转到新标签页，0：当前页打开。最少需1个'),
                        'section' => 'redline_home',
                        'priority' => 10, // 可选择的排序优先级以加载控件。默认值：10
                        'type' => 'textarea', // Can be either text, email, url, number, hidden, or date
                        'capability' => 'edit_theme_options', // 可选择的默认值：'edit_theme_options'
                        'input_attrs' => array( // Optional.
                            'class' => 'my-custom-class',
                            'style' => 'border: 1px solid #999',
                            'placeholder' => __('图片链接|跳转链接|0或1'),
                        ),
                    )
                );
                //首页 - 置顶推荐
                $wp_customize->add_setting(
                    'home_recommend',
                    array(
                        'default' => $home['recommend'],
                        'transport' => 'refresh',
                        'sanitize_callback' => 'wp_filter_nohtml_kses'
                    )
                );

                $wp_customize->add_control(
                    'home_recommend',
                    array(
                        'label' => __('置顶推荐'),
                        'description' => esc_html__('请按格式输入，一行一个：图片链接|跳转链接|0或1；1：跳转到新标签页，0：当前页打开。最少需4个'),
                        'section' => 'redline_home',
                        'priority' => 10,
                        'type' => 'textarea',
                        'capability' => 'edit_theme_options',
                        'input_attrs' => array(
                            'class' => 'my-custom-class',
                            'style' => 'border: 1px solid #999',
                            'placeholder' => __('图片链接|跳转链接|0或1'),
                        ),
                    )
                );

                //首页 热点推荐
                $wp_customize->add_setting(
                    'home_hot',
                    array(
                        'default' => $home['hot'],
                        'transport' => 'refresh',
                        'sanitize_callback' => 'wp_filter_nohtml_kses'
                    )
                );

                $wp_customize->add_control(
                    'home_hot',
                    array(
                        'label' => __('热点推荐'),
                        'description' => esc_html__('请输入文章ID，一行一个，最少需4篇文章'),
                        'section' => 'redline_home',
                        'priority' => 10,
                        'type' => 'textarea',
                        'capability' => 'edit_theme_options',
                        'input_attrs' => array(
                            'class' => 'my-custom-class',
                            'style' => 'border: 1px solid #999',
                            'placeholder' => __('格式：文章ID 回车键 文章ID'),
                        ),
                    )
                );
                //首页 精选文章
                $wp_customize->add_setting(
                    'home_selected',
                    array(
                        'default' => $home['selected'],
                        'transport' => 'refresh',
                        'sanitize_callback' => 'wp_filter_nohtml_kses'
                    )
                );

                $wp_customize->add_control(
                    'home_selected',
                    array(
                        'label' => __('精选文章'),
                        'description' => esc_html__('请输入文章ID，一行一个，最少需7篇文章'),
                        'section' => 'redline_home',
                        'priority' => 10,
                        'type' => 'textarea',
                        'capability' => 'edit_theme_options',
                        'input_attrs' => array(
                            'class' => 'my-custom-class',
                            'style' => 'border: 1px solid #999',
                            'placeholder' => __('格式：文章ID 回车键 文章ID'),
                        ),
                    )
                );
                //首页 末尾推荐
                $wp_customize->add_setting(
                    'home_end',
                    array(
                        'default' => $home['end'],
                        'transport' => 'refresh',
                        'sanitize_callback' => 'wp_filter_nohtml_kses'
                    )
                );

                $wp_customize->add_control(
                    'home_end',
                    array(
                        'label' => __('推荐'),
                        'description' => esc_html__('请按格式输入文章ID，一行一个，最少需4篇文章'),
                        'section' => 'redline_home',
                        'priority' => 10,
                        'type' => 'textarea',
                        'capability' => 'edit_theme_options',
                        'input_attrs' => array(
                            'class' => 'my-custom-class',
                            'style' => 'border: 1px solid #999',
                            'placeholder' => __('格式：文章ID回车键文章ID'),
                        ),
                    )
                );
            }
        }
        /**
         * 选项改变时，添加样式
         */
        public static function add_custom_js()
        {
?>
            <script>
                (function($) {
                    var homeShowTextInput = document.getElementById("customize-control-home_show");

                    wp.customize('home_switch', function(value) {
                        value.bind(function(newVal) {
                            if (newVal === 'false') {
                                $('#customize-control-home_show').show();

                            } else {
                                $('#customize-control-home_show').hide();

                            }
                        });
                    });
                })(jQuery);
            </script>
<?php
        }
    } //end
}
