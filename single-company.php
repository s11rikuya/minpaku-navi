<?php get_header(); ?>

<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-12">
    <?php while (have_posts()) : the_post(); ?>
        <article class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <!-- ヘッダーセクション -->
            <div class="relative h-80 overflow-hidden">
                <?php if (has_post_thumbnail()) : ?>
                    <!-- アイキャッチ画像背景 -->
                    <div class="absolute inset-0">
                        <?php the_post_thumbnail('large', [
                            'class' => 'w-full h-full object-cover',
                            'alt' => get_the_title() . 'の画像'
                        ]); ?>
                    </div>
                    <!-- 画像オーバーレイ -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10"></div>
                <?php else : ?>
                    <!-- デフォルト背景 -->
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800">
                        <!-- パターン背景 -->
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
                        <!-- デフォルト背景用のアイコン -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-white/20 text-8xl">🏢</div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- 会社情報オーバーレイ -->
                <div class="absolute bottom-0 left-0 right-0 px-2 sm:px-6 pb-4 sm:pb-6 z-20">
                    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 border border-white/20 max-w-4xl mx-auto">
                        <div class="text-center md:text-left">
                            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 break-words">
                                <?php the_title(); ?>
                            </h1>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- メインコンテンツ -->
            <div class="mt-8 px-4 sm:px-6 pb-12">
                <!-- 会社説明 -->
                <?php if (get_the_content()) : ?>
                    <div class="max-w-none mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">会社概要</h2>
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>

                <!-- 会社情報グリッド -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- サービス情報 -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">サービス情報</h2>
                        
                        <!-- 基本サービス情報 -->
                        <div class="space-y-4 mb-6">
                            <?php
                            $service_fields = array(
                                'service_type' => 'サービスタイプ',
                                'fee_structure' => '料金体系',
                                'property_count_raw' => '管理物件数'
                            );

                            foreach ($service_fields as $field_id => $label) {
                                $value = get_post_meta(get_the_ID(), $field_id, true);
                                if ($value) {
                                    echo '<div class="flex items-start py-3 border-b border-gray-200 last:border-0">';
                                    echo '<span class="text-sm font-medium text-gray-500 w-32 flex-shrink-0">' . esc_html($label) . '</span>';
                                    if ($field_id === 'property_count_raw') {
                                        echo '<span class="text-sm text-gray-900 ml-2">' . esc_html($value) . ' 件</span>';
                                    } else {
                                        echo '<span class="text-sm text-gray-900 ml-2">' . esc_html($value) . '</span>';
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                        
                        <!-- サービス特徴 -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">サービス特徴</h3>
                            <div class="space-y-2">
                                <?php
                                $features = array(
                                    'support_24h' => '24時間対応',
                                    'airbnb_partner' => 'Airbnbパートナー',
                                    'cleaning_included' => '清掃込み'
                                );

                                $has_features = false;
                                foreach ($features as $feature_id => $label) {
                                    $value = get_post_meta(get_the_ID(), $feature_id, true);
                                    if ($value === 'Yes') {
                                        $has_features = true;
                                        echo '<div class="flex items-center">';
                                        echo '<svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">';
                                        echo '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />';
                                        echo '</svg>';
                                        echo '<span class="text-sm text-gray-700">' . esc_html($label) . '</span>';
                                        echo '</div>';
                                    }
                                }
                                
                                if (!$has_features) {
                                    echo '<p class="text-sm text-gray-500">特別な特徴の記載はありません</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- 対応地域 -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">対応地域</h2>
                        <?php
                        $service_areas = get_post_meta(get_the_ID(), 'service_areas', true);
                        if ($service_areas && is_array($service_areas) && !empty($service_areas)) :
                        ?>
                            <div class="grid grid-cols-2 gap-2">
                                <?php foreach ($service_areas as $area) : ?>
                                    <span class="text-sm text-gray-700 bg-white px-2 py-1 rounded border border-gray-200">
                                        <?php echo esc_html($area); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <p class="text-sm text-gray-500">対応地域の情報はありません</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- お問い合わせ・アクション -->
                <div class="mt-8 bg-primary-50 rounded-xl p-6">
                    <div class="text-center">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">この会社にお問い合わせ</h2>
                        <p class="text-gray-600 mb-6">
                            <?php echo esc_html(get_the_title()); ?>に関するご質問や<br>
                            サービス内容の詳細についてお問い合わせください
                        </p>
                        <a href="<?php echo esc_url(site_url('/contact')); ?>?subject=<?php echo urlencode('【' . get_the_title() . '】お問い合わせ'); ?>" 
                           class="inline-flex items-center px-8 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-medium text-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            お問い合わせする
                        </a>
                    </div>
                    
                    <!-- 管理者向け情報表示 -->
                    <?php if (current_user_can('edit_posts')) : ?>
                        <div class="mt-6 pt-6 border-t border-primary-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3">管理者向け情報</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <?php
                                $company_url = get_post_meta(get_the_ID(), 'company_url', true);
                                $company_tel = get_post_meta(get_the_ID(), 'company_tel', true);
                                ?>
                                
                                <?php if ($company_url) : ?>
                                    <div class="bg-white rounded-lg p-3 border border-gray-200">
                                        <span class="text-gray-500 block mb-1">Webサイト:</span>
                                        <a href="<?php echo esc_url($company_url); ?>" target="_blank" class="text-primary-600 hover:text-primary-700 break-all">
                                            <?php echo esc_html($company_url); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($company_tel) : ?>
                                    <div class="bg-white rounded-lg p-3 border border-gray-200">
                                        <span class="text-gray-500 block mb-1">電話番号:</span>
                                        <a href="tel:<?php echo esc_attr(str_replace(array('-', ' ', '(', ')'), '', $company_tel)); ?>" class="text-primary-600 hover:text-primary-700">
                                            <?php echo esc_html($company_tel); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>

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
    <?php endwhile; ?>
</div>

<?php get_footer(); ?> 