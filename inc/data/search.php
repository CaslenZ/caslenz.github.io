<?php
//搜索信息
if (!class_exists('Reli_Data_Search')) {
    class Reli_Data_Search
    {
        public static function run()
        {
            //当前是搜索页
            return is_search() ? self::get_query_data() : "当前不是搜索页";
        }
        /**
         * 输出查询信息
         */
        public static function get_query_data()
        {

            //准备搜索结果信息
            $search_query = get_search_query();  // 获取搜索关键字

            $args = array(
                's' => $search_query,  // 设置搜索关键字
            );

            $search_query = new WP_Query($args);  // 执行搜索查询

            $results = array();

            if ($search_query->have_posts()) {
                //准备相关信息
                global $wp_query;
                $meat = array(
                    'total_results' => $wp_query->found_posts, //搜索结果数量
                    'current_page' => max(1, get_query_var('paged')), //当前页码
                    'total_pages' => $wp_query->max_num_pages, //总页数
                    'query' => get_search_query(), //当前搜索的问题
                );
                $results["meat"] = $meat;  // 将相关数据添加到数组中

                // 循环遍历搜索结果
                while ($search_query->have_posts()) {
                    $search_query->the_post();
                    $excerpt = get_the_excerpt(); // 获取文章摘要
                    $decodedExcerpt = html_entity_decode($excerpt); // 反转义摘要中的实体编码

                    // 将每篇文章或结果的信息添加到数组中
                    $result = array(
                        'id' => get_the_ID(),  // 文章ID
                        'title' => get_the_title(),  // 文章标题
                        'excerpt' => $decodedExcerpt,  // 文章摘要
                        'link' => get_permalink(),          // 文章链接
                        'featured_image' => get_the_post_thumbnail_url()  // 特色图片URL
                        // 添加其他需要的信息
                    );

                    $results["content"][] = $result;  // 将结果添加到数组中
                }




                // 重置 post 数据，以防影响后续的 wp_query
                wp_reset_postdata();
            } else {
                $results["content"] = [];
                $results["meat"]['query'] = get_search_query();  // 将相关数据添加到数组中
            }

            // 输出结果数组
            return $results;
        }
    } //end
}
