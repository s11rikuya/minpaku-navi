<?php
/**
 * 検索条件表示テンプレートパーツ
 */

if (!defined('ABSPATH')) {
    exit;
}

// 検索条件があるかチェック
$has_filters = !empty($_GET['area']) || !empty($_GET['fee']) || !empty($_GET['service']) || !empty($_GET['s']) || !empty($_GET['orderby']);

if (!$has_filters) {
    return;
}

// 検索条件のラベルを取得
$labels = get_search_condition_labels();

// ソートラベル
$sort_labels = array(
    'date' => '新着順',
    'title' => '名前順',
    'property_count' => '管理物件数順'
);
?>

<div class="mb-8 bg-white rounded-xl p-6 shadow-sm border border-gray-200">
    <div class="flex flex-wrap items-center gap-4 mb-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900">検索条件</h3>
        </div>
        <div class="flex flex-wrap gap-2">
            
            <?php if (!empty($_GET['s'])) : ?>
                <span class="inline-flex items-center px-3 py-1 bg-yellow-50 text-yellow-800 text-sm font-medium rounded-full border border-yellow-200">
                    キーワード: "<?php echo esc_html($_GET['s']); ?>"
                </span>
            <?php endif; ?>
            
            <?php if (!empty($_GET['area'])) : ?>
                <?php $area_label = $labels['area'][$_GET['area']] ?? $_GET['area']; ?>
                <span class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-800 text-sm font-medium rounded-full border border-blue-200">
                    <?php echo esc_html($area_label); ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($_GET['fee'])) : ?>
                <?php $fee_label = $labels['fee'][$_GET['fee']] ?? $_GET['fee']; ?>
                <span class="inline-flex items-center px-3 py-1 bg-green-50 text-green-800 text-sm font-medium rounded-full border border-green-200">
                    <?php echo esc_html($fee_label); ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($_GET['service'])) : ?>
                <?php $service_label = $labels['service'][$_GET['service']] ?? $_GET['service']; ?>
                <span class="inline-flex items-center px-3 py-1 bg-purple-50 text-purple-800 text-sm font-medium rounded-full border border-purple-200">
                    <?php echo esc_html($service_label); ?>
                </span>
            <?php endif; ?>
            
            <?php if (!empty($_GET['orderby'])) : ?>
                <?php $sort_label = $sort_labels[$_GET['orderby']] ?? $_GET['orderby']; ?>
                <span class="inline-flex items-center px-3 py-1 bg-gray-50 text-gray-800 text-sm font-medium rounded-full border border-gray-200">
                    <?php echo esc_html($sort_label); ?>
                </span>
            <?php endif; ?>
            
        </div>
    </div>
    
    <div class="flex items-center justify-between">
        <div class="text-sm text-gray-600">
            <?php
            global $wp_query;
            echo $wp_query->found_posts; 
            ?> 社が見つかりました
            
            <?php if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('manage_options')) : ?>
                <span class="ml-4 text-xs text-gray-400">
                    デバッグ: <?php echo print_r($wp_query->query_vars['meta_query'] ?? 'No meta query', true); ?>
                </span>
            <?php endif; ?>
        </div>
        <a href="<?php echo get_post_type_archive_link('company'); ?>" 
           class="text-sm text-primary-600 hover:text-primary-700 font-medium inline-flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            すべて表示
        </a>
    </div>
</div> 