<?php get_header(); ?>

<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-12">
    <!-- ページヘッダー -->
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            📰 最新記事・お知らせ
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            民泊運営に役立つ情報や、業界の最新ニュースをお届けします
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- メインコンテンツ -->
        <div class="lg:col-span-2">
            <?php if (have_posts()) : ?>
                <div class="space-y-8">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card overflow-hidden'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="relative">
                                    <a href="<?php the_permalink(); ?>" class="block">
                                        <?php the_post_thumbnail('large', ['class' => 'w-full h-64 object-cover transition-transform duration-300 hover:scale-105']); ?>
                                    </a>
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-primary-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                            📝 新着
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="p-6">
                                <header class="mb-4">
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <time datetime="<?php echo get_the_date('c'); ?>" class="flex items-center">
                                            📅 <?php echo get_the_date(); ?>
                                        </time>
                                        <?php
                                        $categories = get_the_category();
                                        if ($categories) :
                                        ?>
                                            <span class="mx-3">•</span>
                                            <div class="flex items-center space-x-2">
                                                <?php
                                                foreach ($categories as $category) {
                                                    echo '<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs font-medium">' . esc_html($category->name) . '</span>';
                                                }
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 hover:text-primary-600 transition-colors">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                </header>

                                <div class="prose max-w-none mb-4 text-gray-600">
                                    <?php the_excerpt(); ?>
                                </div>

                                <footer class="flex items-center justify-between">
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                                        続きを読む
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                    
                                    <div class="flex items-center text-xs text-gray-400">
                                        👤 <?php the_author(); ?>
                                    </div>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php if ($wp_query->max_num_pages > 1) : ?>
                    <!-- ページネーション -->
                    <nav class="mt-12 mb-8" aria-label="ブログページナビゲーション">
                        <div class="flex flex-col items-center space-y-4">
                            <!-- ページ情報 -->
                            <div class="text-center text-sm text-gray-600">
                                <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 rounded-full">
                                    📰 全 <?php echo $wp_query->found_posts; ?> 記事中 
                                    <?php 
                                    $paged = max(1, get_query_var('paged'));
                                    $posts_per_page = get_option('posts_per_page');
                                    echo (($paged - 1) * $posts_per_page + 1); 
                                    ?>〜<?php echo min($paged * $posts_per_page, $wp_query->found_posts); ?> 記事を表示
                                </span>
                            </div>
                            
                            <!-- ページネーションボタン -->
                            <div class="flex flex-wrap justify-center gap-2">
                                <?php
                                $pagination_args = array(
                                    'current' => max(1, get_query_var('paged')),
                                    'total' => $wp_query->max_num_pages,
                                    'type' => 'array',
                                    'prev_text' => '前へ',
                                    'next_text' => '次へ',
                                    'end_size' => 2,
                                    'mid_size' => 1,
                                );
                                
                                $pagination_links = paginate_links($pagination_args);
                                
                                if ($pagination_links) {
                                    foreach ($pagination_links as $link) {
                                        // 現在のページかどうかをチェック
                                        if (strpos($link, 'current') !== false) {
                                            // 現在のページ
                                            echo '<span class="pagination-current">' . strip_tags($link) . '</span>';
                                        } elseif (strpos($link, 'prev') !== false) {
                                            // 前へボタン
                                            echo str_replace('<a ', '<a class="pagination-nav pagination-prev" ', $link);
                                        } elseif (strpos($link, 'next') !== false) {
                                            // 次へボタン
                                            echo str_replace('<a ', '<a class="pagination-nav pagination-next" ', $link);
                                        } elseif (strpos($link, 'dots') !== false) {
                                            // ドット
                                            echo '<span class="pagination-dots">…</span>';
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
                                <span class="text-gray-600">ページ移動:</span>
                                <form method="get" class="inline-flex items-center space-x-2">
                                    <?php
                                    // 現在のクエリパラメータを保持
                                    foreach ($_GET as $key => $value) {
                                        if ($key !== 'paged') {
                                            echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                                        }
                                    }
                                    ?>
                                    <input type="number" name="paged" min="1" max="<?php echo $wp_query->max_num_pages; ?>" 
                                           value="<?php echo max(1, get_query_var('paged')); ?>" 
                                           class="pagination-input w-16 px-2 py-1 text-center border border-gray-300 rounded-lg focus:border-primary-400 focus:ring-primary-400 text-sm">
                                    <span class="text-gray-500">/ <?php echo $wp_query->max_num_pages; ?></span>
                                    <button type="submit" class="px-3 py-1 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors text-sm">
                                        移動
                                    </button>
                                </form>
                            </div>
                        </div>
                    </nav>
                <?php endif; ?>

            <?php else : ?>
                <div class="text-center py-12">
                    <div class="mb-6">
                        <span class="text-6xl">📝</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">まだ記事がありません</h2>
                    <p class="text-gray-500 mb-8">
                        近日中に民泊運営に役立つ記事を公開予定です。<br>
                        お楽しみにお待ちください！
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                        🏠 トップページに戻る
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- サイドバー -->
        <div class="lg:col-span-1">
            <div class="space-y-8">
                <!-- 検索フォーム -->
                <div class="card p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        記事を検索
                    </h3>
                    <?php get_search_form(); ?>
                </div>

                <!-- カテゴリー一覧 -->
                <div class="card p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        📂 カテゴリー
                    </h3>
                    <ul class="space-y-2">
                        <?php
                        wp_list_categories(array(
                            'title_li' => '',
                            'show_count' => true,
                            'style' => 'list',
                        ));
                        ?>
                    </ul>
                </div>

                <!-- 人気記事 -->
                <div class="card p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        人気記事
                    </h3>
                    <?php
                    $popular_posts = wp_get_recent_posts(array(
                        'numberposts' => 5,
                        'post_status' => 'publish'
                    ));
                    if ($popular_posts) :
                    ?>
                        <ul class="space-y-4">
                            <?php
                            foreach ($popular_posts as $post) :
                                setup_postdata($post['ID']);
                            ?>
                                <li>
                                    <a href="<?php echo get_permalink($post['ID']); ?>" class="block hover:bg-gray-50 rounded-lg p-2 -m-2 transition-colors">
                                        <h4 class="text-sm font-medium text-gray-900 hover:text-primary-600 transition-colors line-clamp-2">
                                            <?php echo $post['post_title']; ?>
                                        </h4>
                                        <time datetime="<?php echo get_the_date('c', $post['ID']); ?>" class="text-xs text-gray-500 mt-1 block flex items-center">
                                            📅 <?php echo get_the_date('', $post['ID']); ?>
                                        </time>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- 運営会社へのリンク -->
                <div class="card p-6 bg-gradient-to-br from-primary-50 to-secondary-50">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        運営会社を探す
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        あなたにピッタリの民泊運営会社を見つけませんか？
                    </p>
                    <a href="<?php echo esc_url(site_url('/companies')); ?>" class="btn-primary w-full justify-center">
                        🚀 運営会社を探す
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?> 