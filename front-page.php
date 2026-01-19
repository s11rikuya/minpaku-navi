<?php get_header(); ?>

<!-- ヒーローセクション -->
<section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS13aWR0aD0iMSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNncmlkKSIvPjwvc3ZnPg==')]"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
        <div class="max-w-4xl">
            <div class="inline-block mb-6">
                <span class="px-4 py-2 bg-primary-600 text-white text-sm font-bold uppercase tracking-wider rounded">
                    民泊運営代行会社 比較サイト
                </span>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                最適な民泊運営パートナーを<br>
                データで比較・選定
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-300 mb-8 leading-relaxed">
                全国150社以上の運営代行会社から、<br class="hidden md:block">
                料金・実績・サービス内容を徹底比較。
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="<?php echo esc_url(site_url('/companies')); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    運営会社を検索
                </a>
                <a href="<?php echo esc_url(site_url('/contact')); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 text-white font-bold rounded-lg hover:bg-white/20 transition-colors border-2 border-white/30">
                    相談する
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 主要機能・バリュープロポジション -->
<section class="py-16 md:py-20 bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">詳細比較機能</h3>
                <p class="text-gray-600">料金体系・対応エリア・サービス内容を一覧で比較可能</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">実績データ公開</h3>
                <p class="text-gray-600">管理物件数・運営実績など客観的データを掲載</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">無料相談対応</h3>
                <p class="text-gray-600">専門スタッフが最適な運営会社選びをサポート</p>
            </div>
        </div>
    </div>
</section>

<!-- 検索セクション -->
<section class="py-16 md:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">運営会社を検索</h2>
            <p class="text-lg text-gray-600">条件を指定して最適な運営会社を見つける</p>
        </div>
        
        <div class="max-w-5xl mx-auto bg-white rounded-lg shadow-lg p-6 md:p-8 border border-gray-200">
            <form action="<?php echo esc_url(get_post_type_archive_link('company')); ?>" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- エリア -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">対応エリア</label>
                        <select name="area" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="">全国</option>
                            <?php
                            $area_options = get_area_options_for_search();
                            if (!empty($area_options['major'])) :
                            ?>
                                <optgroup label="主要都市">
                                    <?php foreach ($area_options['major'] as $key => $label) : ?>
                                        <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <!-- 料金帯 -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">料金帯</label>
                        <select name="fee" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="">すべて</option>
                            <option value="low">〜10%</option>
                            <option value="middle">11〜15%</option>
                            <option value="high">16%〜</option>
                        </select>
                    </div>
                    
                    <!-- サービス -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">サービス</label>
                        <select name="service" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="">指定なし</option>
                            <option value="cleaning">清掃込み</option>
                            <option value="24h">24時間対応</option>
                            <option value="airbnb">Airbnbパートナー</option>
                        </select>
                    </div>
                    
                    <!-- 検索ボタン -->
                    <div class="flex items-end">
                        <button type="submit" class="w-full px-6 py-3 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors">
                            検索
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- 統計データ -->
<section class="py-16 md:py-20 bg-gradient-to-r from-primary-600 to-primary-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">プラットフォーム実績</h2>
            <p class="text-xl text-white/90">信頼される民泊運営会社比較サイト</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold mb-2">150+</div>
                <div class="text-white/90 font-medium">掲載企業数</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold mb-2">5,000+</div>
                <div class="text-white/90 font-medium">管理物件総数</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold mb-2">47</div>
                <div class="text-white/90 font-medium">都道府県対応</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold mb-2">24/7</div>
                <div class="text-white/90 font-medium">サポート体制</div>
            </div>
        </div>
    </div>
</section>

<!-- 厳選企業 -->
<section class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <span class="px-4 py-2 bg-primary-100 text-primary-700 text-sm font-bold uppercase tracking-wider rounded">
                    Featured Companies
                </span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">厳選された運営会社</h2>
            <p class="text-lg text-gray-600">実績・サービス品質で選定した優良企業</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <?php
            $featured_companies = new WP_Query(array(
                'post_type' => 'company',
                'posts_per_page' => 6,
                'meta_query' => array(
                    array(
                        'key' => 'featured',
                        'value' => 'yes',
                        'compare' => '='
                    )
                )
            ));
            
            if ($featured_companies->have_posts()) :
                while ($featured_companies->have_posts()) : $featured_companies->the_post();
                    $fee_structure = get_post_meta(get_the_ID(), 'fee_structure', true);
                    $property_count = get_post_meta(get_the_ID(), 'property_count_raw', true);
                    $service_areas = get_post_meta(get_the_ID(), 'service_areas', true);
            ?>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="h-48 overflow-hidden bg-gray-100">
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                <a href="<?php the_permalink(); ?>" class="hover:text-primary-600 transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <div class="space-y-2 mb-4 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">料金体系</span>
                                    <span class="font-bold text-gray-900"><?php echo esc_html($fee_structure); ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">管理物件</span>
                                    <span class="font-bold text-gray-900"><?php echo esc_html($property_count); ?>件</span>
                                </div>
                                <?php if ($service_areas && is_array($service_areas)) : ?>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">対応地域</span>
                                    <span class="font-bold text-gray-900"><?php echo count($service_areas); ?>地域</span>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="block w-full text-center px-4 py-3 bg-gray-900 text-white font-bold rounded-lg hover:bg-gray-800 transition-colors">
                                詳細を見る
                            </a>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // フィーチャーされた会社がない場合は、最新の6社を表示
                $latest_companies = new WP_Query(array(
                    'post_type' => 'company',
                    'posts_per_page' => 6
                ));
                
                if ($latest_companies->have_posts()) :
                    while ($latest_companies->have_posts()) : $latest_companies->the_post();
                        $fee_structure = get_post_meta(get_the_ID(), 'fee_structure', true);
                        $property_count = get_post_meta(get_the_ID(), 'property_count_raw', true);
            ?>
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="h-48 overflow-hidden bg-gray-100">
                                    <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-primary-600 transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                
                                <div class="space-y-2 mb-4 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">料金体系</span>
                                        <span class="font-bold text-gray-900"><?php echo esc_html($fee_structure); ?></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">管理物件</span>
                                        <span class="font-bold text-gray-900"><?php echo esc_html($property_count); ?>件</span>
                                    </div>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="block w-full text-center px-4 py-3 bg-gray-900 text-white font-bold rounded-lg hover:bg-gray-800 transition-colors">
                                    詳細を見る
                                </a>
                            </div>
                        </div>
            <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
            endif;
            ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="<?php echo esc_url(site_url('/companies')); ?>" class="inline-flex items-center px-8 py-4 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors">
                すべての運営会社を見る
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- サービス内容 -->
<section class="py-16 md:py-20 bg-gray-50 border-y border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">民泊運営代行サービス</h2>
            <p class="text-lg text-gray-600">運営会社が提供する主要サービス</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg border border-gray-200">
                <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">物件管理</h3>
                <p class="text-gray-600 leading-relaxed">清掃・メンテナンス・鍵の管理など、物件管理業務を包括的にサポート</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg border border-gray-200">
                <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">ゲスト対応</h3>
                <p class="text-gray-600 leading-relaxed">24時間365日の多言語対応。チェックイン・問い合わせ対応を一括管理</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg border border-gray-200">
                <div class="w-14 h-14 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">収益最適化</h3>
                <p class="text-gray-600 leading-relaxed">データ分析・価格設定・マーケティングによる収益向上サポート</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 md:py-20 bg-gray-900 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">運営パートナーをお探しですか？</h2>
        <p class="text-xl text-gray-300 mb-8">
            全国の民泊運営代行会社を比較検討し、<br class="hidden md:block">
            最適なパートナーを見つけることができます。
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo esc_url(site_url('/companies')); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition-colors">
                運営会社を検索
            </a>
            <a href="<?php echo esc_url(site_url('/contact')); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-900 font-bold rounded-lg hover:bg-gray-100 transition-colors">
                無料相談
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
