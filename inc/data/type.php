<?php
//页面类型信息
if (!class_exists('Reli_Data_Type')) {
    class Reli_Data_Type
    {
        public static function run()
        {
            $array = array(
                'page_type' => self::get_page_type(),
                'device' => self::device(),
            );
            return $array;
        }
        /**
         * 当前设备类型
         */
        public static function device()
        {
            if (wp_is_mobile()) {
                return "mobile";
            } else {
                return "pc";
            }
        }
        //当前页面类型
        public static function get_page_type()
        {
            if (is_home()) {
                // 当前页面是首页
                return "home";
            }
            if (is_single()) {
                // 当前页面是文章页
                return "single";
            }
            if (is_page()) {
                // 当前页面是搜索页
                return "page";
            }
            if (is_404()) {
                // 当前页面是404页
                return "404";
            }

            if (is_search()) {
                // 当前页面是搜索页
                return "search";
            }
            if (is_category()) {
                // 当前页面是分类页
                return "category";
            }
            if (is_tag()) {
                // 当前页面是标签页
                return "tag";
            }
            if (is_attachment()) {
                // 当前页面是附件页
                return "attachment";
            }
            if (is_author()) {
                // 当前页面是作者页
                return "author";
            }


            // 其他类型的页面
            return "about";
        }
    }
}
