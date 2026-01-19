<?php
/**
 * 検索条件表示テンプレートパーツ
 */

if (!defined('ABSPATH')) {
    exit;
}

// 検索条件があるかチェック
$has_filters = !empty($_GET['area']) || !empty($_GET['fee']) || !empty($_GET['service']);

if (!$has_filters) {
    return;
}

// 検索条件のラベルを取得
$labels = get_search_condition_labels();
?>

<div class="mb-8 bg-white rounded-xl p-6 shadow-sm border border-gray-200">
    <div class="flex flex-wrap items-center gap-4 mb-4">
        <h3 class="text-lg font-semibold text-gray-900">🔍 検索条件</h3>
        <div class="flex flex-wrap gap-2">
            
            <?php if (!empty($_GET['area'])) : ?>
                <?php $area_label = $labels['area'][$_GET['area']] ?? $_GET['area']; ?>
                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                    エリア: <?php echo esc_html($area_label); ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($_GET['fee'])) : ?>
                <?php $fee_label = $labels['fee'][$_GET['fee']] ?? $_GET['fee']; ?>
                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                    料金帯: <?php echo esc_html($fee_label); ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($_GET['service'])) : ?>
                <?php $service_label = $labels['service'][$_GET['service']] ?? $_GET['service']; ?>
                <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">
                    サービス: <?php echo esc_html($service_label); ?>
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
           class="text-sm text-primary-600 hover:text-primary-700 font-medium">
            🔄 すべて表示
        </a>
    </div>
</div> 