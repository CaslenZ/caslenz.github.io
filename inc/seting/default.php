<?php
//默认值
if (!class_exists('Reli_Seting_Default')) {
    class Reli_Seting_Default
    {

        public static function run($option)
        {
            $logo = get_template_directory_uri() . "/vite/dist/img/logo.svg";
            $meat = "COPYRIGHT © 2022 THIN RED LINE INC. ALL RIGHTS RESERVED.";

            $array = array(
                'header' => array(
                    'logo' =>  $logo,
                ),
                'home' => array(
                    'switch' => "false", //首页开关
                    'show' => "1", //首页开关
                    'slid' => "", //幻灯片
                    'recommend' => "", //置顶推荐
                    'hot' => "", //置顶推荐
                    'selected' => "", //精选文章
                    'end' => "35345", //末尾推荐
                ),
                'footer' => array(
                    'meat' =>  $meat,
                ),
            );

            $data = $array[$option];
            return $data;
        }
    }
}
