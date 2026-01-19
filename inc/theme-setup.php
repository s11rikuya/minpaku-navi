<?php
/**
 * テーマの基本設定
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * テーマのセットアップ
 */
function minpaku_portal_setup() {
    // テーマサポートを追加
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // メニューサポート
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));

    // カスタム画像サイズ
    add_image_size('company-logo', 300, 200, true);
    add_image_size('company-hero', 800, 400, true);
}
add_action('after_setup_theme', 'minpaku_portal_setup');

/**
 * サイドバーの登録
 */
function minpaku_portal_widgets_init() {
    register_sidebar(array(
        'name'          => 'サイドバー',
        'id'            => 'sidebar-1',
        'description'   => 'サイドバーウィジェットエリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'フッター',
        'id'            => 'footer-1',
        'description'   => 'フッターウィジェットエリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'minpaku_portal_widgets_init'); 