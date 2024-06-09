<?php
//提供数据
if (!class_exists('Reli_Data')) {
    class Reli_Data
    {
        public static $plugin_name;
        public static $plugin_version;

        public static function run($name, $version)
        {
            //传值
            self::$plugin_name = $name;
            self::$plugin_version = $version;
            self::load();
            add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_custom_styles'));
        }

        public static function load()
        {
            require_once get_template_directory() . '/inc/data/menu.php';
            require_once get_template_directory() . '/inc/data/site.php';
            require_once get_template_directory() . '/inc/data/type.php';
            require_once get_template_directory() . '/inc/data/widgets.php';

            require_once get_template_directory() . '/inc/data/home.php';
            require_once get_template_directory() . '/inc/data/single.php';
            require_once get_template_directory() . '/inc/data/search.php';
            require_once get_template_directory() . '/inc/data/category.php';
            require_once get_template_directory() . '/inc/data/tag.php';
        }
        /**
         * 准备传递的资源
         */
        public static function site_data()
        {
            //当前页面ID
            $id = get_queried_object_id();

            //当前页面类型和设备类型
            $type = Reli_Data_Type::run();

            //传递信息
            $data = array(
                'site' => Reli_Data_Site::run(),
                'menu' => Reli_Data_Menu::run(),
                'type' => $type,
                'config' => Reli_Data_Home::config(), //通用设置信息
               // 'widgets'=>Reli_Data_Widgets::run(),//小工具信息
            );




            switch ($type['page_type']) {
                case 'home': //首页


                    $home = Reli_Data_Home::run(); //首页信息
                    $home_switch = $home['switch']; //拿到首页判断
                    $home_show = $home['home_show']; //拿到首页展示ID
                    $device =  $type['device']; //设备类型

                    //开启首页
                    if ($home_switch === "true") {
                        if ($device === "pc") {
                            $data['home']['pc'] = $home; //PC 设备
                        } else {
                            $data['home']['mobile'] = Reli_Data_Home::home_mobile_data(); //移动设备
                        }
                    } else {
                        $data['single'] = Reli_Data_Single::run($home_show); //自定义文章
                    }




                    break;
                case 'single':
                case 'page':
                    $data['single'] = Reli_Data_Single::run($id); //页面信息
                    break;
                case  'search':
                    $data['search'] = Reli_Data_Search::run(); //搜索内容
                    break;
                case  'category':
                    $data['category'] = Reli_Data_Category::run(); //搜索内容
                    break;
                case  'tag':
                    $data['tag'] = Reli_Data_Tag::run(); //搜索内容
                    break;
                default:
                    break;
            }

            return $data;
        }
        /**
         * 加载JS，传递数据
         */
        public static function enqueue_custom_styles()
        {
            //版本信息
            $ver = self::$plugin_version;
            $name = self::$plugin_name;

            //准备传递的数据
            $data = self::site_data();

            wp_enqueue_style($name, get_template_directory_uri() . '/vite/dist/assets/index.css', '', $ver,);
            wp_enqueue_script($name, get_template_directory_uri() . '/vite/dist/index.js', array(), $ver, true);

            wp_localize_script($name, 'dataLocal', $data); //传给vite项目
        }
    }
}
