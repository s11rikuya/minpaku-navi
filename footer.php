    </main>

    <footer class="bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-12 px-2 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- サイト情報 -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <span class="text-xl font-bold text-gray-900">
                                <?php bloginfo('name'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <p class="text-gray-500 text-sm">
                        <?php bloginfo('description'); ?>
                    </p>
                </div>

                <!-- クイックリンク -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">
                        クイックリンク
                    </h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-base text-gray-500 hover:text-gray-900">
                                ホーム
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(get_post_type_archive_link('company')); ?>" class="text-base text-gray-500 hover:text-gray-900">
                                運営会社一覧
                            </a>
                        </li>
                        <?php if (get_privacy_policy_url()) : ?>
                            <li>
                                <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="text-base text-gray-500 hover:text-gray-900">
                                    プライバシーポリシー
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- お問い合わせ -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">
                        お問い合わせ
                    </h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="text-base text-gray-500 hover:text-gray-900">
                                お問い合わせフォーム
                            </a>
                        </li>
                    <!-- ここから：LINE公式アカウント画像リンク -->
                    <li>
                        <a href="https://lin.ee/CcPftbU"
                           target="_blank" rel="noopener"
                           aria-label="LINE公式アカウントへ（友だち追加／お問い合わせ）">
                            <img
                                src="https://hudousanlink.jp/wp-content/uploads/2025/09/admin-ajax-1.png"
                                alt="LINEでお問い合わせ / 友だち追加"
                                loading="lazy"
                                class="h-10 md:h-12 w-auto"
                            />
                        </a>
                    </li>
                    <!-- ここまで -->
</li>

                    </ul>
                </div>
            </div>

            <!-- コピーライト -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <p class="text-center text-sm text-gray-400">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html> 