<?php
//小工具
if (!class_exists('Reli_Data_Widgets')) {
    class Reli_Data_Widgets
    {
        public static function run()
        {
            return self::get_red_line_sidebar_menu_content();
        }
        public static function get_red_line_sidebar_menu_content()
        {
            ob_start(); // 开始缓冲输出

            dynamic_sidebar('red_line_sidebar_menu'); // 输出小工具内容到缓冲区

            $sidebar_content = ob_get_clean(); // 获取缓冲区内容并清除缓冲区

            return $sidebar_content; // 返回小工具内容
        }
    }
}
