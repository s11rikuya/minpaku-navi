<?php get_header(); ?>

<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-8">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- メインコンテンツ -->
                <div class="lg:col-span-2">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card overflow-hidden mb-8'); ?>>
                        <!-- アイキャッチ画像 -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="relative">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-64 md:h-80 object-cover']); ?>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-primary-500 text-white px-3 py-1.5 rounded-full text-sm font-medium">
                                        📝 記事
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="py-6 px-5 md:p-8">
                            <!-- 記事ヘッダー -->
                            <header class="mb-6">
                                <div class="flex flex-wrap items-center text-sm text-gray-500 mb-4 gap-4">
                                    <time datetime="<?php echo get_the_date('c'); ?>" class="flex items-center">
                                        📅 <?php echo get_the_date(); ?>
                                    </time>
                                    
                                    <?php
                                    $categories = get_the_category();
                                    if ($categories) :
                                    ?>
                                        <div class="flex items-center space-x-2">
                                            <span>📂</span>
                                            <?php
                                            foreach ($categories as $category) {
                                                echo '<a href="' . get_category_link($category->term_id) . '" class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-xs font-medium hover:bg-primary-200 transition-colors">' . esc_html($category->name) . '</a>';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="flex items-center">
                                        👤 <?php the_author(); ?>
                                    </div>
                                </div>
                                
                                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight">
                                    <?php the_title(); ?>
                                </h1>
                            </header>

                            <!-- 記事本文 -->
                            <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-a:text-primary-600 prose-a:no-underline hover:prose-a:text-primary-700">
                                <?php the_content(); ?>
                            </div>

                            <!-- タグ -->
                            <?php
                            $tags = get_the_tags();
                            if ($tags) :
                            ?>
                                <div class="mt-8 pt-6 border-t border-gray-200">
                                    <div class="flex items-center mb-3">
                                        <span class="text-sm font-semibold text-gray-700 flex items-center">
                                            🏷️ タグ:
                                        </span>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        <?php foreach ($tags as $tag) : ?>
                                            <a href="<?php echo get_tag_link($tag->term_id); ?>" class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors">
                                                <?php echo esc_html($tag->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- シェアボタン -->
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <div class="flex items-center mb-3">
                                    <span class="text-sm font-semibold text-gray-700 flex items-center">
                                        📤 この記事をシェア:
                                    </span>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                       target="_blank" 
                                       class="bg-blue-500 text-white px-2 py-2 rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors">
                                        🐦 Twitter
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                       target="_blank" 
                                       class="bg-blue-600 text-white px-2 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                        👥 Facebook
                                    </a>
                                    <a href="https://line.me/R/msg/text/?<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" 
                                       target="_blank" 
                                       class="bg-green-500 text-white px-2 py-2 rounded-lg text-sm font-medium hover:bg-green-600 transition-colors">
                                        💬 LINE
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- 記事ナビゲーション -->
                    <nav class="mb-8" aria-label="記事ナビゲーション">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                            ?>
                            
                            <?php if ($prev_post) : ?>
                                <a href="<?php echo get_permalink($prev_post); ?>" class="card p-6 hover:shadow-lg transition-shadow group">
                                    <div class="text-sm text-gray-500 mb-2 flex items-center">
                                        ← 前の記事
                                    </div>
                                    <h3 class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors line-clamp-2">
                                        <?php echo get_the_title($prev_post); ?>
                                    </h3>
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($next_post) : ?>
                                <a href="<?php echo get_permalink($next_post); ?>" class="card p-6 hover:shadow-lg transition-shadow group text-right">
                                    <div class="text-sm text-gray-500 mb-2 flex items-center justify-end">
                                        次の記事 →
                                    </div>
                                    <h3 class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors line-clamp-2">
                                        <?php echo get_the_title($next_post); ?>
                                    </h3>
                                </a>
                            <?php endif; ?>
                        </div>
                    </nav>

                    <!-- 関連記事 -->
                    <?php
                    $categories = get_the_category();
                    if ($categories) {
                        $category_ids = array();
                        foreach ($categories as $category) {
                            $category_ids[] = $category->term_id;
                        }
                        
                        $related_posts = new WP_Query(array(
                            'category__in' => $category_ids,
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 3,
                            'orderby' => 'rand'
                        ));
                        
                        if ($related_posts->have_posts()) :
                    ?>
                            <section class="mb-8">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    🔗 関連記事
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                        <article class="card overflow-hidden">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="relative">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-40 object-cover transition-transform duration-300 hover:scale-105']); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="p-4">
                                                <div class="text-xs text-gray-500 mb-2 flex items-center">
                                                    📅 <?php echo get_the_date(); ?>
                                                </div>
                                                <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-2">
                                                    <a href="<?php the_permalink(); ?>" class="hover:text-primary-600 transition-colors">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <p class="text-xs text-gray-600 line-clamp-2">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 10); ?>
                                                </p>
                                            </div>
                                        </article>
                                    <?php endwhile; ?>
                                </div>
                            </section>
                    <?php
                        endif;
                        wp_reset_postdata();
                    }
                    ?>

                <!-- 情報修正・掲載依頼セクション -->
                <div class="mt-6 md:mt-8 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <!-- 情報修正依頼 -->
            <div class="card p-4 md:p-6 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100">
                <div class="text-center">
                    <div class="mb-3 md:mb-4">
                        <span class="text-3xl md:text-4xl">✏️</span>
                    </div>
                    <h3 class="text-base md:text-lg font-bold text-gray-900 mb-2 md:mb-3">情報の修正依頼</h3>
                    <p class="text-xs md:text-sm text-gray-600 mb-3 md:mb-4">
                        掲載されている情報に誤りがある場合や<br>
                        最新の情報に更新したい場合はこちら
                    </p>
                    <a href="<?php echo esc_url(site_url('/contact')); ?>?subject=<?php echo urlencode('【' . get_the_title() . '】情報修正依頼'); ?>" 
                       class="btn-primary w-full justify-center text-sm md:text-base">
                        📝 修正依頼をする
                    </a>
                </div>
            </div>

            <!-- 掲載依頼 -->
            <div class="card p-4 md:p-6 bg-gradient-to-br from-green-50 to-emerald-50 border border-green-100">
                <div class="text-center">
                    <div class="mb-3 md:mb-4">
                        <span class="text-3xl md:text-4xl">📢</span>
                    </div>
                    <h3 class="text-base md:text-lg font-bold text-gray-900 mb-2 md:mb-3">掲載依頼</h3>
                    <p class="text-xs md:text-sm text-gray-600 mb-3 md:mb-4">
                        あなたの運営会社も当サイトに<br>
                        掲載しませんか？無料でご相談可能です
                    </p>
                    <a href="<?php echo esc_url(site_url('/contact')); ?>?subject=<?php echo urlencode('運営会社掲載依頼'); ?>" 
                       class="btn-secondary w-full justify-center text-sm md:text-base">
                        🚀 掲載依頼をする
                    </a>
                </div>
            </div>
        </div>
                </div>

                <!-- サイドバー -->
                <div class="lg:col-span-1">
                    <div class="space-y-6">
                        <!-- 検索フォーム -->
                        <div class="card p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                🔍 記事を検索
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
                                🔥 人気記事
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
                                        if ($post['ID'] == get_the_ID()) continue; // 現在の記事を除外
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

                        <!-- 記事一覧へのリンク -->
                        <div class="card p-6 bg-gradient-to-br from-secondary-50 to-primary-50">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                📚 記事一覧
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">
                                他の記事もチェックしてみませんか？
                            </p>
                            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn-secondary w-full justify-center">
                                📰 記事一覧を見る
                            </a>
                        </div>

                        <!-- 運営会社へのリンク -->
                        <div class="card p-6 bg-gradient-to-br from-primary-50 to-warm-50">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                🏢 運営会社を探す
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
        <?php endwhile; ?>
    <?php else : ?>
        <div class="text-center py-12">
            <div class="mb-6">
                <span class="text-6xl">😕</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-4">記事が見つかりませんでした</h1>
            <p class="text-gray-500 mb-8">
                お探しの記事は削除されたか、移動された可能性があります。
            </p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                🏠 トップページに戻る
            </a>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?> 