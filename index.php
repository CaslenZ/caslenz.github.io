<?php

get_header();

$data =  Reli_Seting::home_config();
//$datas =  Reli_Seting::config();
//echo '<pre>' . print_r($data, true) . '</pre>';

?>


<!--提供节点-->
<div id="app">
    <noscript>
        <?php
        //加载模版内容
        get_template_part('/inc/ambush/content', 'single')
        ?>
    </noscript>
</div>




<!--
    <?php
    // 在页面加载完成后获取数据库查询次数
    $query_count = get_num_queries();
    // 在页面加载完成后获取内存使用情况
    $memory_usage = memory_get_usage(true) / 1024;
    $peak_memory_usage = memory_get_peak_usage(true) / 1024;
    echo '数据库查询次数：' . $query_count;
    echo '<br/>加载耗时：' . timer_stop(0, 6) . ' 秒';
    echo '<br/>内存使用情况：' . $memory_usage  . ' KB';
    echo '<br/>内存峰值使用情况：' . $peak_memory_usage . ' KB';
    ?>
    -->
<?php


// 页面内容...

get_footer();
