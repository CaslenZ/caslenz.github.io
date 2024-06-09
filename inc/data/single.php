<?php
//获取文章信息
if (!class_exists('Reli_Data_Single')) {
    class Reli_Data_Single
    {
        //输出指定ID的文章内容
        public static function run($id)
        {
            $array = [
                'content' => self::get_post_content($id),
                'meat' => self::red_line_handle_meat($id),
            ];

            return $array;
        }

        //替换为处理好的区块内容
        private static function get_post_content($id)
        {
            $content = get_post($id); // 获取文章信息

            if ($content instanceof WP_Post) {
                $content->post_content = self::get_the_content_output($content);
            }

            return $content;
        }

        //处理区块内容
        private static function get_the_content_output($post)
        {
            if ($post instanceof WP_Post) {
                $output = apply_filters('the_content', $post->post_content);
                $output = wpautop($output);

                return $output;
            }

            return '';
        }

        //获取文章源信息
        private static function red_line_handle_meat($post_id)
        {
            $array = [
                'site' => get_post_meta($post_id, 'red_line_site', true),
                'switch' => get_post_meta($post_id, 'red_line_switch', true),
            ];

            return $array;
        }
    }
}
