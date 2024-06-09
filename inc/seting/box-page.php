<?php
//文章设置
if (!class_exists('Reli_Seting_Meat')) {
    class Reli_Seting_Meat
    {
        public static function run()
        {
            //添加选项
            add_action('add_meta_boxes', array(__CLASS__, 'custom_meta_boxes_post'));

             //添加选项到页面
             add_action('add_meta_boxes', array(__CLASS__, 'custom_meta_boxes_page'));

            //保存值
            add_action('save_post', array(__CLASS__, 'save_custom_fields'));
        }
        // 添加自定义字段和开关选项到文章
        public static function custom_meta_boxes_post()
        {
            add_meta_box(
                'custom_fields', // 自定义字段框的 ID
                'RedLine主题选项', // 自定义字段框的标题
                array(__CLASS__, 'render_custom_fields'), // 渲染自定义字段的回调函数
                'post', // 只在文章编辑页面显示
                'normal', // 显示在默认位置
                'high' // 设置优先级为高
            );
        }

                // 添加自定义字段和开关选项到页面
                public static function custom_meta_boxes_page()
                {
                    add_meta_box(
                        'custom_fields', // 自定义字段框的 ID
                        'RedLine主题选项', // 自定义字段框的标题
                        array(__CLASS__, 'render_custom_fields'), // 渲染自定义字段的回调函数
                        'page', // 只在文章编辑页面显示
                        'normal', // 显示在默认位置
                        'high' // 设置优先级为高
                    );
                }


        // 渲染自定义字段的回调函数
        public static function render_custom_fields($post)
        {
            // 获取存储在自定义字段中的值
            $custom_field_1_value = get_post_meta($post->ID, 'red_line_site', true);

            $custom_field_switch_value = get_post_meta($post->ID, 'red_line_switch', true);
?>
            <label for="red_line_switch">在菜单中显示为重点：</label>
            <input type="checkbox" name="red_line_switch" id="red_line_switch" <?php checked($custom_field_switch_value, 'true'); ?>>


            <br>
            <label for="red_line_site">沉浸阅读网址（弹窗展示网址）：</label>
            <input type="text" name="red_line_site" id="red_line_site" value="<?php echo esc_attr($custom_field_1_value); ?>">

<?php
        }

        // 保存自定义字段和开关选项的值
        public static function save_custom_fields($post_id)
        {
            if (isset($_POST['red_line_site'])) {
                update_post_meta($post_id, 'red_line_site', sanitize_text_field($_POST['red_line_site']));
            }

            $red_line_switch_value = isset($_POST['red_line_switch']) ? 'true' : 'false';
            update_post_meta($post_id, 'red_line_switch', $red_line_switch_value);
        }
    }
}
