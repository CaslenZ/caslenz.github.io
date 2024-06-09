<?php
//网址信息
if (!class_exists('Reli_Data_Site')) {
    class Reli_Data_Site
    {
        public static function run()
        {
            //网址
            $site = array(
                'ajaxurl' => admin_url('admin-ajax.php'), //传递ajax地址
                'home' => home_url(), //首页网址
                'theme' => get_template_directory_uri(),  //主题目录网址
            );
            return $site;
        }
    }
}
