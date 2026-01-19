<?php
/**
 * Template Name: 固定ページ
 */

get_header(); ?>

<main class="main-content">
    <div class="container mx-auto px-2 py-8">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-6'); ?>>
                    <header class="entry-header mb-6">
                        <h1 class="entry-title text-3xl font-bold text-gray-900">
                            <?php the_title(); ?>
                        </h1>
                    </header>

                    <div class="entry-content prose max-w-none">
                        <?php the_content(); ?>
                    </div>

           
                </article>
                         <!-- 情報修正・掲載依頼セクション -->
                    <!-- 情報修正・掲載依頼セクション -->
        <div class="mt-6 md:mt-8 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <!-- 情報修正依頼 -->
            <div class="card p-4 md:p-6 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100">
                <div class="text-center">
                    <div class="mb-3 md:mb-4">
                        <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
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
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?> 