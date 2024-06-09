<?php
//分类信息
if (!class_exists('Reli_Data_Category')) {
    class Reli_Data_Category
    {
        private static $current_category;
        
        public static function run()
        {
            self::$current_category = get_queried_object();

            $array = array();
            //判断当前是分类页
            if (is_category()) {
                $array = array(
                    'meat' => self::meat(), //分类名称
                    'content' => self::single(), //分类ID
                );
                return $array;
            } else {
                return "当前不是分类页";
            }
        }
        /**
         * 获取分类信息
         */
        public static function meat()
        {

            $array = array(
                'id' => self::$current_category->term_id, //分类ID
                'link'=>get_category_link(self::$current_category),//分类链接
                'name' => self::$current_category->name, //分类名称
                'description' => self::$current_category->description, //分类描述
            );
            return $array;
        }
        /**
         * 获取分类下的文章信息
         */
        public static function single()
        {
            //存储数据
            $results = array();

            $args = array(
                'category_name' => self::$current_category->slug, // 使用当前分类的别名作为查询参数
            );

            $query = new WP_Query($args);



            // 循环遍历查询结果
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $excerpt = get_the_excerpt(); // 获取文章摘要
                    $decodedExcerpt = html_entity_decode($excerpt); // 反转义摘要中的实体编码
                    $array = array(
                        'id' => get_the_ID(), //文章ID
                        'link' => get_permalink(), //文章链接
                        'title' => get_the_title(), //文章标题
                        'description' => $decodedExcerpt, //文章描述
                        'featured_image' => get_the_post_thumbnail_url(), //缩略图
                    );
                    $results[] = $array;
                }
                // 重置 post 数据，以防影响后续的 wp_query
                wp_reset_postdata();
                return  $results;
            } else {
                // 如果没有文章
                return  $results;
            }
        }
    }
}
