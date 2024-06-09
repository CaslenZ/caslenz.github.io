<?php
//准备首页信息
if (!class_exists('Reli_Data_Home')) {
    class Reli_Data_Home
    {
        /**
         * 自定义首页数据信息
         */
        public static function run()
        {
            $data = Reli_Seting::home_config();
            return $data;
        }
        //通用设置信息
        public static function config()
        {
            $data = Reli_Seting::config();
            return $data;
        }
        /**
         * 自定义，移动端首页文章信息
         * 获取文章的起始位置
         * 每次获取的文章数量
         */
        public static function home_mobile_data($offset = 0, $limit = 9)
        {
            $args = array(
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => $limit,
                'offset' => $offset,
            );

            $query = new WP_Query($args);

            $array = array(); //存储数据
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $data = array(
                        'id' => get_the_ID(), //文章ID
                        'link' => get_permalink(), //文章链接
                        'title' => get_the_title(), //文章标题
                        'description' => get_the_excerpt(), //文章描述
                        'featured_image' => get_the_post_thumbnail_url(), //缩略图
                    );
                    $array[] = $data;
                }
            }

            wp_reset_postdata();
            return $array;
        }
        // 循环获取所有文章，每次获取10篇，直到没有更多文章为止
        //while (true) {
        //    get_articles($offset, $limit);
        //    $offset += $limit;
        //
        //    if (count(get_articles($offset, 1)) < 1) {
        //        break;
        //    }
        //}
    } //end
}
