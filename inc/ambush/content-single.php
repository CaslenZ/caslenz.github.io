<div class="ambush">
<div class="box">
    <?php

    // 获取主菜单（menu_slug 替换为实际菜单的标识符）
    wp_nav_menu(array(
        'theme_location' => 'red-line-menu',
        'container' => 'nav',
        'container_class' => 'main-menu',
    ));
    ?>
</div>
<div class="content box">
    <?php
    //菜单
    //标题
    //内容
    //上一篇文章
    //下一篇文章
    //相关推荐
    if (have_posts()) { // 判断是否有文章存在
        while (have_posts()) {
            the_post(); // 设置当前文章
            the_title('<h2>', '</h2>'); // 输出当前文章的标题
            // 输出文章描述
            if (has_excerpt()) {
                echo '<p class="post-excerpt">' . get_the_excerpt() . '</p>';
            }
            the_content(); // 输出当前文章的内容
            // 输出上一篇文章和下一篇文章

        }
    }
    ?>
</div>
<!--
    推荐
-->
<?php
echo '<div class="post-navigation box">';
previous_post_link('上一篇：%link');
next_post_link('下一篇：%link');
echo '</div>';
?>
<!--
    分类信息
-->
<?php

if (is_category()) { // 检查是否为分类页面
    echo '<div class="box">';
    $category = get_queried_object(); // 获取当前分类对象

    // 构建 WP_Query 对象
    $args = array(
        'post_type' => 'post',
        'cat' => $category->term_id,
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // 输出文章链接和标题
            echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

            // 输出文章描述
            if (has_excerpt()) {
                echo '<p>' . get_the_excerpt() . '</p>';
            }

            // 输出文章内容
            the_content();
        }
    } else {
        echo '没有找到相关文章';
    }

    wp_reset_postdata(); // 重置查询后的文章数据
    echo '</div>';
}

?>

<?php

if (is_tag()) { // 检查是否为分类页面
    echo '<div class="box">';
    $tag = get_queried_object(); // 获取当前标签对象

    // 构建 WP_Query 对象
    $args = array(
        'post_type' => 'post',
        'tag_id' => $tag->term_id,
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // 输出文章链接和标题
            echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

            // 输出文章描述
            if (has_excerpt()) {
                echo '<p>' . get_the_excerpt() . '</p>';
            }

            // 输出文章内容
            the_content();
        }
    } else {
        echo '没有找到相关文章';
    }

    wp_reset_postdata(); // 重置查询后的文章数据
    echo '</div>';
}

?>
<?php
//推荐文章
// 获取最新的四篇文章
$recommended_posts = get_posts(array(
    'numberposts' => 4, // 获取文章数量
    'orderby'     => 'date', // 按照日期排序
    'order'       => 'DESC', // 降序排列（最新文章在前）
));

if ($recommended_posts) {
    echo '<div class="tuijian box">';
    echo '<h2>推荐文章</h2>';
    echo '<ul>';

    foreach ($recommended_posts as $post) {
        setup_postdata($post);
?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
<?php
    }

    echo '</ul>';
    echo '</div>';
    wp_reset_postdata(); // 重置文章数据
}
?>
</div>