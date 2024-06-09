<?php
define('REDLINE_VERSION', wp_get_theme()->get('Version'));
//启动函数
require_once get_template_directory() . '/inc/index.php';
function run_wpcy()
{

    $plugin = new Reli_Admin();
    $plugin->run();
}
run_wpcy();




//添加菜单
function theme_register_menus()
{
    register_nav_menus(
        array(
            'red-line-menu' => __('细红线菜单', 'theme')
        )
    );
}
add_action('after_setup_theme', 'theme_register_menus');



//开启特色图片支持
add_theme_support('post-thumbnails');





/**
 * 添加小工具
 */

function my_theme_widgets_init()
{
    register_sidebar(array(
        'name'          => __('菜单下内容', 'my-theme'),
        'id'            => 'red_line_sidebar_menu',
        'description'   => __('Add widgets here.', 'my-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'my_theme_widgets_init');


/**
 * 首页更新获取数据接口
 */
add_action('wp_ajax_save_object_option', 'save_object_option_callback');

function save_object_option_callback()
{
    // 拿到ID
    $offset = $_GET['offset'];
    $limit = $_GET['limit'];

    $content = Reli_Data_Home::home_mobile_data($offset, $limit);



    // 发送成功响应
    $response = array(
        'message' => '正常！',
        'content' => $content,
    );
    //wp_send_json_success($response);
    // 使用 wp_send_json 函数发送 JSON 响应，避免汉字转义
    wp_send_json($response, 200, JSON_UNESCAPED_UNICODE);
}
