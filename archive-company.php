<?php get_header(); ?>

<div class="min-h-screen bg-gray-50 py-12 px-2 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- ヘッダーセクション -->
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <svg class="w-16 h-16 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">運営会社一覧</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                信頼できる民泊運営代行会社の情報をご紹介します。<br>
                各社の特徴や料金体系を比較して、最適なパートナーを見つけましょう。
            </p>
        </div>

        <!-- 検索フォーム -->
        <?php get_template_part('template-parts/company-search-form'); ?>

        <!-- 検索条件の表示 -->
        <?php get_template_part('template-parts/company-search-filters'); ?>

        <!-- 会社一覧グリッド -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 md:gap-8">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/company-card'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-span-full text-center py-12">
                    <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">該当する会社が見つかりませんでした</h3>
                    <p class="text-gray-500 mb-6">検索条件を変更してもう一度お試しください</p>
                    <a href="<?php echo get_post_type_archive_link('company'); ?>" class="btn-primary">
                        すべての会社を見る
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- ページネーション -->
        <?php if ($wp_query->max_num_pages > 1) : ?>
            <?php get_template_part('template-parts/company-pagination'); ?>
        <?php endif; ?>

        <!-- CTAセクション -->
        <div class="text-center mt-16 bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    運営会社選びでお悩みの方へ
                </h2>
                <p class="text-gray-600 mb-6">
                    どの運営会社を選べばよいか迷っている方、<br>
                    専門のコンサルタントが無料でアドバイスいたします。
                </p>
                <a href="<?php echo site_url('/contact'); ?>" 
                   class="btn-primary inline-flex items-center text-lg px-8 py-3">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    無料相談を申し込む
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
        
    </div>
</div>

<?php get_footer(); ?> 