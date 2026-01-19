<?php get_header(); ?>

<div class="min-h-screen bg-gray-50 py-12 px-2 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- ヘッダーセクション -->
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <span class="text-5xl">🏢</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">運営会社一覧</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                信頼できる民泊運営代行会社の情報をご紹介します ✨<br>
                各社の特徴や料金体系を比較して、あなたにピッタリのパートナーを見つけましょう
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
                    <div class="text-6xl mb-4">🔍</div>
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
        <div class="text-center mt-16 bg-white rounded-2xl p-8 shadow-lg">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    🤝 お悩みの方はお気軽にご相談ください
                </h2>
                <p class="text-gray-600 mb-6">
                    どの運営会社を選べばよいか迷っている方、<br>
                    専門のコンサルタントが無料でアドバイスいたします
                </p>
                <a href="<?php echo site_url('/contact'); ?>" 
                   class="btn-primary inline-flex items-center text-lg px-8 py-3">
                    📞 無料相談を申し込む
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
        
    </div>
</div>

<?php get_footer(); ?> 