<?php
//菜单信息
if (!class_exists('Reli_Data_Menu')) {
    class Reli_Data_Menu
    {
        public static function run()
        {
            $menu_name = 'red-line-menu';
            $menu = self::get_menu_items($menu_name); //原始菜单数据
            $menu_data = self::organize_menu_items($menu);
            return $menu_data;
        }
        //获取菜单信息
        public static function get_menu_items($menu_name)
        {
            $menu_items = array();

            // 获取菜单对象
            $menu_locations = get_nav_menu_locations();
            $menu_id = $menu_locations[$menu_name] ?? null;
            $menu_object = ($menu_id) ? wp_get_nav_menu_object($menu_id) : null;

            if ($menu_object) {
                // 获取菜单项
                $menu_items = wp_get_nav_menu_items($menu_object->term_id);
            }

            return $menu_items;
        }
        //对菜单信息进行整理
        public static function organize_menu_items($menu_items)
        {
            $top_level_menus = array();
            $menu_map = array();

            // 将菜单项按照父菜单 ID 分组
            foreach ($menu_items as $item) {
                if (!isset($menu_map[$item->menu_item_parent])) {
                    $menu_map[$item->menu_item_parent] = array();
                }
                $menu_map[$item->menu_item_parent][] = $item;
            }

            // 递归构建顶级菜单及其子菜单
            foreach ($menu_items as $item) {
                if ($item->menu_item_parent == 0) {
                    $top_menu = new stdClass();
                    $top_menu->id = $item->object_id;
                    $top_menu->menu = $item->title;
                    $top_menu->list = self::build_submenu($item->ID, $menu_map);
                    $top_level_menus[] = $top_menu;
                }
            }

            return $top_level_menus;
        }

        /**
         * 数据整理
         */
        public static function build_submenu($parent_id, $menu_map)
        {
            $submenu = array();

            if (isset($menu_map[$parent_id])) {

                foreach ($menu_map[$parent_id] as $item) {

                    $submenu_item = new stdClass();
                    $submenu_item->id = $item->object_id;
                    $submenu_item->title = $item->title;
                    $submenu_item->url =  $item->url;

                    //TODO:此处有优化空间

                    $tag =get_post_meta($item->object_id, 'red_line_switch', true); //状态
                    //$tag = red_line_handle_meat($item->object_id);
                    $submenu_item->tag =  $tag;
                   // $submenu_item->tag =  $tag['switch'];
                    //子菜单对象中不再生成list数组对象
                    //$submenu_item->list = build_submenu($item->ID, $menu_map);

                    // 检查是否还有下层子菜单数据
                    $has_children = isset($menu_map[$item->ID]);
                    //$submenu_item->has_children = $has_children;

                    $submenu[] = $submenu_item;

                    // 如果还有下层子菜单数据，将其添加到当前数组中
                    if ($has_children) {
                        $submenu = array_merge($submenu, build_submenu($item->ID, $menu_map));
                    }
                }
            }

            return $submenu;
        }
    }
}
