<?php
/**
 * 運営会社ページネーションテンプレートパーツ
 */

if (!defined('ABSPATH')) {
    exit;
}

global $wp_query;

// ページネーションが必要ない場合は表示しない
if ($wp_query->max_num_pages <= 1) {
    return;
}

$paged = max(1, get_query_var('paged'));
$posts_per_page = 12; // 運営会社一覧は12件固定
?>

<nav class="mt-12 mb-8" aria-label="運営会社ページナビゲーション">
    <div class="flex flex-col items-center space-y-4">
        
        <!-- ページ情報 -->
        <div class="text-center text-sm text-gray-600">
            <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 rounded-full">
                全 <?php echo $wp_query->found_posts; ?> 社中 
                <?php echo (($paged - 1) * $posts_per_page + 1); ?>〜<?php echo min($paged * $posts_per_page, $wp_query->found_posts); ?> 社を表示
            </span>
        </div>
        
        <!-- ページネーションボタン -->
        <div class="flex flex-wrap justify-center gap-2">
            <?php
            $pagination_args = array(
                'current' => $paged,
                'total' => $wp_query->max_num_pages,
                'type' => 'array',
                'prev_text' => '<span aria-hidden="true">←</span> 前へ',
                'next_text' => '次へ <span aria-hidden="true">→</span>',
                'end_size' => 2,
                'mid_size' => 1,
                'add_args' => array_intersect_key($_GET, array_flip(['area', 'fee', 'service'])) // 検索パラメータを保持
            );
            
            $pagination_links = paginate_links($pagination_args);
            
            if ($pagination_links) {
                foreach ($pagination_links as $link) {
                    // 現在のページかどうかをチェック
                    if (strpos($link, 'current') !== false) {
                        // 現在のページ
                        echo '<span class="pagination-current" aria-current="page">' . strip_tags($link) . '</span>';
                    } elseif (strpos($link, 'prev') !== false) {
                        // 前へボタン
                        echo str_replace('<a ', '<a class="pagination-nav pagination-prev" aria-label="前のページ" ', $link);
                    } elseif (strpos($link, 'next') !== false) {
                        // 次へボタン
                        echo str_replace('<a ', '<a class="pagination-nav pagination-next" aria-label="次のページ" ', $link);
                    } elseif (strpos($link, 'dots') !== false) {
                        // ドット
                        echo '<span class="pagination-dots" aria-hidden="true">…</span>';
                    } else {
                        // 通常のページ番号
                        echo str_replace('<a ', '<a class="pagination-link" ', $link);
                    }
                }
            }
            ?>
        </div>
        
        <!-- ページジャンプ -->
        <div class="flex items-center space-x-2 text-sm">
            <label for="page-jump" class="text-gray-600">ページ移動:</label>
            <form method="get" class="inline-flex items-center space-x-2" aria-label="ページジャンプ">
                <?php
                // 現在の検索パラメータを保持
                foreach ($_GET as $key => $value) {
                    if ($key !== 'paged' && in_array($key, ['area', 'fee', 'service'])) {
                        echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                    }
                }
                ?>
                <input type="number" 
                       id="page-jump"
                       name="paged" 
                       min="1" 
                       max="<?php echo $wp_query->max_num_pages; ?>" 
                       value="<?php echo $paged; ?>" 
                       class="pagination-input w-16 px-2 py-1 text-center border border-gray-300 rounded-lg focus:border-primary-400 focus:ring-primary-400 text-sm"
                       aria-label="ページ番号を入力">
                <span class="text-gray-500">/ <?php echo $wp_query->max_num_pages; ?></span>
                <button type="submit" 
                        class="px-3 py-1 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                        aria-label="指定したページに移動">
                    移動
                </button>
            </form>
        </div>
        
    </div>
</nav> 