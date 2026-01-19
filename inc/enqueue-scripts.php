<?php
/**
 * スタイルとスクリプトの読み込み
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * スタイルとスクリプトの読み込み
 */
function minpaku_portal_scripts() {
    // Tailwind CSSのコンパイル済みファイルを読み込み
    wp_enqueue_style(
        'tailwind-style',
        get_template_directory_uri() . '/dist/style.css',
        array(),
        filemtime(get_template_directory() . '/dist/style.css')
    );
    
    // テーマのカスタムスタイル
    wp_enqueue_style(
        'theme-style',
        get_stylesheet_uri(),
        array('tailwind-style'),
        filemtime(get_template_directory() . '/style.css')
    );
    
    // メインJavaScript
    wp_enqueue_script(
        'theme-script',
        get_template_directory_uri() . '/js/main.js',
        array(),
        filemtime(get_template_directory() . '/js/main.js'),
        true
    );

    // 個別ページでのみ読み込むスクリプト
    if (is_singular('company')) {
        wp_enqueue_script(
            'company-detail-script',
            get_template_directory_uri() . '/js/company-detail.js',
            array('jquery'),
            filemtime(get_template_directory() . '/js/main.js'),
            true
        );
    }

    // Contact Form 7が有効な場合の追加スタイル
    if (is_page('contact') && function_exists('wpcf7_enqueue_scripts')) {
        wp_enqueue_style(
            'contact-form-style',
            get_template_directory_uri() . '/css/contact-form.css',
            array('theme-style'),
            '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'minpaku_portal_scripts');

/**
 * 管理画面でのスタイル読み込み
 */
function minpaku_portal_admin_scripts($hook) {
    // Company投稿タイプの編集画面でのみ読み込み
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        global $post_type;
        if ($post_type === 'company') {
            wp_enqueue_style(
                'company-admin-style',
                get_template_directory_uri() . '/css/admin-company.css',
                array(),
                '1.0.0'
            );
            
            wp_enqueue_script(
                'company-admin-script',
                get_template_directory_uri() . '/js/admin-company.js',
                array('jquery'),
                '1.0.0',
                true
            );
        }
    }
}
add_action('admin_enqueue_scripts', 'minpaku_portal_admin_scripts'); 