<?php
//设置
if (!class_exists('Reli_Seting')) {
    class Reli_Seting
    {
        public static function run()
        {
            //加载文件
            self::load();
            Reli_Seting_Header::run();
            Reli_Seting_Footer::run();
            Reli_Seting_Home::run();

            //文章内设置
            Reli_Seting_Meat::run();
        }
        /**
         * 加载文件
         */
        public static function load()
        {
            //顶部设置
            require_once get_template_directory() . '/inc/seting/headers.php';

            //首页设置
            require_once get_template_directory() . '/inc/seting/home.php';

            //底部设置
            require_once get_template_directory() . '/inc/seting/footer.php';

            //默认值
            require_once get_template_directory() . '/inc/seting/default.php';

            //文章设置
            require_once get_template_directory() . '/inc/seting/box-page.php';

            //数据处理工具
            require_once get_template_directory() . '/inc/seting/tool.php';
        }
        //整理通用设置数据
        public static function config()
        {
            $header = Reli_Seting_Default::run("header");
            $footer = Reli_Seting_Default::run("footer");

            $array = array(
                'header' => array(
                    'logo' =>  get_theme_mod('header_logo', $header['logo']),
                ),
                'footer' => array(
                    'meat' =>  get_theme_mod('footer_meat', $footer['meat']),
                    'test' => $footer['meat'],
                ),

            );

            return $array;
        }

        //整理首页设置数据并传递给JS文件
        public static function home_config()
        {
            //默认值
            $home = Reli_Seting_Default::run("home");
            /**
             * 首页
             */
            $switch = get_theme_mod('home_switch', $home['switch']); //首页开关
            $home_show = get_theme_mod('home_show', $home['show']); //首页关闭时展示的内容
            $slid = get_theme_mod('home_slid', $home['slid']);
            $recommend = get_theme_mod('home_recommend', $home['recommend']);
            $hot = get_theme_mod('home_hot', $home['hot']);
            $selected = get_theme_mod('home_selected', $home['selected']);
            $end = get_theme_mod('home_end', $home['end']);

           
                $array = array(
                    'switch'=>$switch,
                    'home_show'=>$home_show,
                    'slid' => Reli_Seting_Tool::handle_array_data($slid), //幻灯片
                    'recommend' => Reli_Seting_Tool::handle_array_data($recommend), //置顶推荐
                    'hot' => Reli_Seting_Tool::handle_post_id($hot), //置顶推荐
                    'selected' => Reli_Seting_Tool::handle_post_id($selected), //精选文章
                    'end' => Reli_Seting_Tool::handle_post_id($end), //末尾推荐
                );
          
                //若关闭首页，则展示指定ID的文章或页面内容
               // $array =  Reli_Data_Single::run($home_show);
            







            return $array;
        }
    }
}
