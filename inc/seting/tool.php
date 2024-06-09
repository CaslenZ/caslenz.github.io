<?php
//工具信息
if (!class_exists('Reli_Seting_Tool')) {
    class Reli_Seting_Tool
    {
        public static function run()
        {
        }
        /**
         * 处理指定内容 sss|sss|1
         */
        public static function handle_array_data($content)
        {
            $lines = explode("\n", $content);
            $result = array();
            $id = 1; // 初始化计数器变量为 1

            foreach ($lines as $line) {
                $elements = explode("|", $line);

                if (count($elements) == 3) {
                    $image = trim($elements[0]);
                    $link = trim($elements[1]);
                    $type = ($elements[2] === "1") ? "true" : "false";

                    $item = array(
                        'id' => $id, // 将计数器变量作为 ID 值
                        'featured_image' => $image,
                        'link' => $link,
                        'type' => $type,
                    );

                    $result[] = $item;
                    $id++; // 每次循环结束后递增计数器变量
                }
            }

            return $result;
        }

        /**
         * 解析文章ID信息
         */
        public static function getPostInfo($postId)
        {
            $post = get_post($postId); // 根据文章 ID 获取文章对象

            if ($post) {
                $postInfo = array(
                    'id' => $post->ID,
                    'link' => get_permalink($post->ID), // 添加链接到数组中
                    'title' => $post->post_title,
                    'description' => $post->post_excerpt,
                    'featured_image' => get_the_post_thumbnail_url($post->ID),
                );

                return $postInfo;
            }

            return null;
        }

        public static function handle_post_id($content)
        {
            $lines = explode("\n", $content);
            $result = array();

            foreach ($lines as $line) {
                $postId = trim($line);
                $postInfo = self::getPostInfo($postId);

                if ($postInfo) {
                    $result[] = $postInfo;
                }
            }
            return $result;
        }
    }
}
