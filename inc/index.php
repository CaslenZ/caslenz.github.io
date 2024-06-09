<?php
if (!class_exists('Reli_Admin')) {
    class Reli_Admin
    {
        protected $plugin_name;
        protected $version;

        public function __construct()
        {
            if (defined('REDLINE_VERSION')) {
                $this->version = REDLINE_VERSION;
            } else {
                $this->version = '0.0.1';
            }
            $this->plugin_name = 'red_line';

            $this->load();
            $this->run();
            //$this->define_public_hooks();

        }
        /**
         * 加载
         */
        private static function load()
        {
            //设置
            //添加设置信息
            require_once get_template_directory() . '/inc/seting/index.php';

            //数据准备
            require_once get_template_directory() . '/inc/data/index.php';
        }
        /**
         * 运行
         */
        public  function run()
        {
            //设置信息
            Reli_Seting::run();
            
            //添加传递的值
            Reli_Data::run($this->plugin_name, $this->version);
        }
    }
}
