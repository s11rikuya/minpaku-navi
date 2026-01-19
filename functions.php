<?php
/**
 * MinPaku Portal Theme Functions
 * 
 * このファイルは分割されたテーマ機能ファイルを読み込みます。
 * 各機能は個別のファイルに分離されており、保守性が向上しています。
 */

// 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

// テーマのバージョン定数
define('MINPAKU_THEME_VERSION', '1.0.0');

// テーマディレクトリのパス定数
define('MINPAKU_THEME_DIR', get_template_directory());
define('MINPAKU_THEME_URL', get_template_directory_uri());

/**
 * 必要なファイルをインクルード
 */
$include_files = array(
    'inc/theme-setup.php',           // テーマの基本設定
    'inc/enqueue-scripts.php',       // スタイル・スクリプトの読み込み
    'inc/class-tailwind-walker-nav-menu.php', // ナビゲーションウォーカークラス
    'inc/search-filters.php',        // 検索フィルタリング機能
    'inc/csv-management.php',        // CSV管理機能
    'inc/custom-post-types.php',     // カスタム投稿タイプとフィールド
);

foreach ($include_files as $file) {
    $file_path = MINPAKU_THEME_DIR . '/' . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    } else {
        // デバッグモードでエラーを表示
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log("Missing file: {$file_path}");
        }
    }
}



/**
 * Contact Form 7のカスタムスタイル
 */
function add_contact_form_css() {
    if (is_page('contact') && function_exists('wpcf7_enqueue_scripts')) {
    ?>
    <style>
        /* Contact Form 7カスタマイズ */
        .wpcf7-form {
            @apply space-y-6;
        }
        .wpcf7-form input[type="text"],
        .wpcf7-form input[type="email"],
        .wpcf7-form input[type="tel"],
        .wpcf7-form textarea,
        .wpcf7-form select {
            @apply w-full rounded-xl border-gray-200 focus:border-primary-400 focus:ring-primary-400;
        }
        .wpcf7-form input[type="submit"] {
            @apply btn-primary w-full text-lg py-3;
        }
        .wpcf7-response-output {
            @apply rounded-xl p-4 mb-4;
        }
        .wpcf7-mail-sent-ok {
            @apply bg-green-50 text-green-800 border border-green-200;
        }
        .wpcf7-validation-errors {
            @apply bg-red-50 text-red-800 border border-red-200;
        }
        </style>
        <?php
    }
}
add_action('wp_head', 'add_contact_form_css');

/**
 * セキュリティ関連の設定
 */
function minpaku_security_setup() {
    // WordPressバージョンの非表示
    remove_action('wp_head', 'wp_generator');
    
    // 不要なWordPressヘッダー情報を削除
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
}
add_action('init', 'minpaku_security_setup');

/**
 * パフォーマンス最適化
 */
function minpaku_performance_optimization() {
    // 絵文字スクリプトを無効化（必要に応じて）
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    
    // WordPressのjQueryを削除して独自版を使用（フロントエンドのみ）
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false);
    }
}
add_action('init', 'minpaku_performance_optimization');

/**
 * ユーティリティ関数
 */

/**
 * 価格をフォーマット
 */
function format_price($price) {
    if (empty($price)) {
        return '';
    }
    return number_format($price) . '円';
}

/**
 * URLの妥当性チェック
 */
function is_valid_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

/**
 * 電話番号のフォーマット
 */
function format_phone_number($phone) {
    if (empty($phone)) {
        return '';
    }
    // 簡単なフォーマット例
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (strlen($phone) === 11) {
        return substr($phone, 0, 3) . '-' . substr($phone, 3, 4) . '-' . substr($phone, 7);
    }
    return $phone;
}

/**
 * エラーハンドリング（開発環境のみ）
 */
if (defined('WP_DEBUG') && WP_DEBUG) {
    /**
     * テーマのデバッグ情報を出力
     */
    function minpaku_debug_info() {
        if (current_user_can('manage_options')) {
            $debug_info = array(
                'Theme Version' => MINPAKU_THEME_VERSION,
                'WordPress Version' => get_bloginfo('version'),
                'PHP Version' => phpversion(),
                'Active Plugins' => count(get_option('active_plugins')),
            );
            
            echo '<!-- Debug Info: ' . wp_json_encode($debug_info) . ' -->';
        }
    }
    add_action('wp_footer', 'minpaku_debug_info');
}

/**
 * SEO対応 - OGPタグとメタディスクリプションの出力
 */
function minpaku_add_ogp_meta_tags() {
    global $post;
    
    // 基本情報の取得
    $site_name = get_bloginfo('name');
    $site_description = get_bloginfo('description');
    $site_url = home_url();
    
    // ページ別の情報を設定
    if (is_singular('company')) {
        // 会社詳細ページ
        $title = get_the_title() . ' | ' . $site_name;
        $description = get_company_meta_description();
        $url = get_permalink();
        $image = get_company_og_image();
        $type = 'article';
    } elseif (is_home() || is_front_page()) {
        // トップページ
        $title = $site_name;
        $description = $site_description ?: '民泊運営代行会社の比較・検索サイト。信頼できる運営代行会社を見つけて、民泊経営を成功させましょう。';
        $url = $site_url;
        $image = get_theme_file_uri('/assets/images/og-default.jpg');
        $type = 'website';
    } elseif (is_post_type_archive('company')) {
        // 会社一覧ページ
        $title = '運営会社一覧 | ' . $site_name;
        $description = '民泊運営代行会社の一覧です。サービス内容、対応地域、料金体系を比較して最適な会社を見つけましょう。';
        $url = get_post_type_archive_link('company');
        $image = get_theme_file_uri('/assets/images/og-default.jpg');
        $type = 'website';
    } elseif (is_page()) {
        // 固定ページ
        $title = get_the_title() . ' | ' . $site_name;
        $description = get_page_meta_description();
        $url = get_permalink();
        $image = get_page_og_image();
        $type = 'article';
    } else {
        // その他のページ
        $title = wp_get_document_title();
        $description = $site_description;
        $url = get_permalink() ?: $site_url;
        $image = get_theme_file_uri('/assets/images/og-default.jpg');
        $type = 'website';
    }
    
    // メタディスクリプション
    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    
    // OGPタグ
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr($type) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    echo '<meta property="og:image:width" content="1200">' . "\n";
    echo '<meta property="og:image:height" content="630">' . "\n";
    echo '<meta property="og:locale" content="ja_JP">' . "\n";
    
    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
    
    // 構造化データ（JSON-LD）
    if (is_singular('company')) {
        echo_company_structured_data();
    } elseif (is_home() || is_front_page()) {
        echo_website_structured_data();
    }
}
add_action('wp_head', 'minpaku_add_ogp_meta_tags');

/**
 * 会社ページのメタディスクリプション生成
 */
function get_company_meta_description() {
    global $post;
    
    $company_name = get_the_title();
    $service_type = get_post_meta(get_the_ID(), 'service_type', true);
    $service_areas = get_post_meta(get_the_ID(), 'service_areas', true);
    $fee_structure = get_post_meta(get_the_ID(), 'fee_structure', true);
    
    $description = $company_name . 'の民泊運営代行サービス。';
    
    if ($service_type) {
        $description .= 'サービス内容: ' . $service_type . '。';
    }
    
    if ($service_areas && is_array($service_areas) && !empty($service_areas)) {
        $areas = array_slice($service_areas, 0, 3);
        $description .= '対応地域: ' . implode('、', $areas);
        if (count($service_areas) > 3) {
            $description .= '等';
        }
        $description .= '。';
    }
    
    if ($fee_structure) {
        $description .= '料金体系: ' . $fee_structure . '。';
    }
    
    $description .= '詳細情報と見積もり依頼はこちら。';
    
    return $description;
}

/**
 * ページのメタディスクリプション生成
 */
function get_page_meta_description() {
    global $post;
    
    // カスタム抜粋があれば使用
    if (has_excerpt()) {
        return get_the_excerpt();
    }
    
    // コンテンツから抜粋を生成
    $content = get_the_content();
    if ($content) {
        $content = strip_tags($content);
        $content = str_replace(array("\r", "\n", "\t"), ' ', $content);
        $content = preg_replace('/\s+/', ' ', $content);
        return mb_substr($content, 0, 120) . '...';
    }
    
    // デフォルト
    return get_bloginfo('description');
}

/**
 * 会社ページのOG画像取得
 */
function get_company_og_image() {
    if (has_post_thumbnail()) {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
        return $image[0];
    }
    
    return get_theme_file_uri('/assets/images/og-company-default.jpg');
}

/**
 * ページのOG画像取得
 */
function get_page_og_image() {
    if (has_post_thumbnail()) {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
        return $image[0];
    }
    
    return get_theme_file_uri('/assets/images/og-default.jpg');
}

/**
 * 会社ページの構造化データ出力
 */
function echo_company_structured_data() {
    global $post;
    
    $company_name = get_the_title();
    $company_url = get_post_meta(get_the_ID(), 'company_url', true);
    $company_tel = get_post_meta(get_the_ID(), 'company_tel', true);
    $company_address = get_post_meta(get_the_ID(), 'company_address', true);
    $service_areas = get_post_meta(get_the_ID(), 'service_areas', true);
    
    $structured_data = array(
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => $company_name,
        'url' => get_permalink(),
        'description' => get_company_meta_description(),
        'image' => get_company_og_image(),
        'priceRange' => '$$$',
        'serviceType' => '民泊運営代行'
    );
    
    if ($company_url) {
        $structured_data['sameAs'] = array($company_url);
    }
    
    if ($company_tel) {
        $structured_data['telephone'] = $company_tel;
    }
    
    if ($company_address) {
        $structured_data['address'] = array(
            '@type' => 'PostalAddress',
            'addressRegion' => 'JP',
            'addressLocality' => $company_address
        );
    }
    
    if ($service_areas && is_array($service_areas) && !empty($service_areas)) {
        $structured_data['areaServed'] = $service_areas;
    }
    
    echo '<script type="application/ld+json">' . "\n";
    echo json_encode($structured_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}

/**
 * Webサイトの構造化データ出力
 */
function echo_website_structured_data() {
    $structured_data = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => get_bloginfo('name'),
        'url' => home_url(),
        'description' => get_bloginfo('description'),
        'potentialAction' => array(
            '@type' => 'SearchAction',
            'target' => array(
                '@type' => 'EntryPoint',
                'urlTemplate' => home_url('/?s={search_term_string}')
            ),
            'query-input' => 'required name=search_term_string'
        )
    );
    
    echo '<script type="application/ld+json">' . "\n";
    echo json_encode($structured_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
} 