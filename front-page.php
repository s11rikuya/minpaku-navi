<?php get_header(); ?>

<!-- ヒーローセクション -->
<section class="relative overflow-hidden h-[70vh] md:h-[70vh] max-h-[800px] min-h-[500px]">
    <!-- 背景画像 -->
    <div class="absolute inset-0">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-image.jpg" 
             alt="着物を着たカップルが人力車で楽しそうにしている様子" 
             class="w-full h-full object-cover object-center">
        <!-- ボカシと暗くするオーバーレイ -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-transparent to-black/40"></div>
    </div>
    
    
            <div class="relative z-10 max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 flex items-center h-full py-12 md:py-16">
        <div class="text-center w-full">
            <div class="mb-4 md:mb-6 inline-block">
                <span class="inline-flex items-center px-4 py-2 bg-white/20 rounded-md text-white text-xs md:text-sm font-semibold border border-white/30 uppercase tracking-wide">
                    民泊運営代行会社比較サイト
                </span>
            </div>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 md:mb-6 text-white leading-tight drop-shadow-2xl">
                民泊運営代行会社の<br>
                <span class="text-primary-300 drop-shadow-lg">比較・検索プラットフォーム</span>
            </h1>
            <p class="text-base md:text-xl lg:text-2xl mb-6 md:mb-8 max-w-3xl lg:max-w-4xl mx-auto text-white/95 leading-relaxed drop-shadow-lg px-2">
                全国の民泊運営代行会社を網羅的に比較。<br class="hidden md:block">
                実績・料金・サービス内容から最適な運営パートナーを選定できます。
            </p>
            <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center px-2">
                <a href="<?php echo esc_url(site_url('/companies')); ?>" class="btn-primary shadow-xl text-sm md:text-base inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    運営会社を検索
                </a>
                <a href="<?php echo esc_url(site_url('/category/columns')); ?>" class="btn-secondary shadow-xl text-sm md:text-base inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    運営ガイド
                </a>
            </div>
        </div>
    </div>
    
</section>

<!-- 検索セクション -->
<section class="py-12 md:py-16 bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="text-center mb-8 md:mb-12">
            <div class="inline-block mb-4">
                <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">運営会社を条件で検索</h2>
            <p class="text-base md:text-lg text-gray-600">エリア・料金・サービス内容から最適な運営会社を見つけることができます</p>
        </div>
        
        <div class="card p-6 md:p-8 max-w-5xl mx-auto">
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6" action="<?php echo esc_url(get_post_type_archive_link('company')); ?>" method="GET">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 md:mb-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        エリア
                    </label>
                    <select name="area" class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 transition-colors">
                        <option value="">全国</option>
                        <?php
                        $area_options = get_area_options_for_search();
                        $selected_area = isset($_GET['area']) ? $_GET['area'] : '';
                        
                        // 主要都市
                        if (!empty($area_options['major'])) :
                        ?>
                            <optgroup label="主要都市">
                                <?php foreach ($area_options['major'] as $key => $label) : ?>
                                    <option value="<?php echo esc_attr($key); ?>" <?php selected($selected_area, $key); ?>>
                                        <?php echo esc_html($label); ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endif; ?>
                        
                        <?php
                        // 他の地域
                        $region_labels = array(
                            'tohoku' => '東北地方',
                            'kanto' => 'その他関東',
                            'chubu' => '中部地方',
                            'kansai' => 'その他関西',
                            'chugoku' => '中国地方',
                            'shikoku' => '四国地方',
                            'kyushu' => '九州・沖縄'
                        );
                        
                        foreach ($region_labels as $region => $region_label) :
                            if (!empty($area_options[$region])) :
                        ?>
                            <optgroup label="<?php echo esc_attr($region_label); ?>">
                                <?php foreach ($area_options[$region] as $key => $label) : ?>
                                    <option value="<?php echo esc_attr($key); ?>" <?php selected($selected_area, $key); ?>>
                                        <?php echo esc_html($label); ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 md:mb-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        料金帯
                    </label>
                    <select name="fee" class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 transition-colors">
                        <option value="">すべて</option>
                        <option value="low">〜10%（低価格）</option>
                        <option value="middle">11%〜15%（標準）</option>
                        <option value="high">16%〜（プレミアム）</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 md:mb-3 flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        サービス
                    </label>
                    <select name="service" class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 transition-colors">
                        <option value="">指定なし</option>
                        <option value="cleaning">清掃込み</option>
                        <option value="24h">24時間対応</option>
                        <option value="airbnb">Airbnbパートナー</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full btn-primary">
                        検索する
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- おすすめ運営会社 -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center mx-auto">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">厳選された運営会社</h2>
            <p class="text-lg text-gray-600">実績・評価・サービス品質で選定した優良企業</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $featured_companies = new WP_Query(array(
                'post_type' => 'company',
                'posts_per_page' => 3,
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
                    $airbnb_partner = get_post_meta(get_the_ID(), 'airbnb_partner', true);
                    $support_24h = get_post_meta(get_the_ID(), 'support_24h', true);
            ?>
                    <div class="card p-6 hover:shadow-xl transition-shadow">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mb-4 relative overflow-hidden rounded-lg">
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
                                <div class="absolute top-3 right-3">
                                    <span class="bg-primary-600 text-white px-3 py-1.5 rounded-md text-xs font-semibold uppercase tracking-wide">
                                        Featured
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            <a href="<?php the_permalink(); ?>" class="hover:text-primary-600 transition-colors">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </p>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500 flex items-center">料金体系:</span>
                                <span class="text-sm font-semibold text-primary-600"><?php echo esc_html($fee_structure); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500 flex items-center">管理物件数:</span>
                                <span class="text-sm font-semibold text-secondary-600"><?php echo esc_html($property_count); ?>件</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php if ($airbnb_partner === 'Yes') : ?>
                                <span class="feature-badge">
                                    Airbnbパートナー
                                </span>
                            <?php endif; ?>
                            <?php if ($support_24h === 'Yes') : ?>
                                <span class="feature-badge">
                                    24時間対応
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="w-full btn-primary justify-center">
                            詳細を見る
                        </a>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // フィーチャーされた会社がない場合は、最新の3社を表示
                $latest_companies = new WP_Query(array(
                    'post_type' => 'company',
                    'posts_per_page' => 3
                ));
                
                if ($latest_companies->have_posts()) :
                    while ($latest_companies->have_posts()) : $latest_companies->the_post();
                        $fee_structure = get_post_meta(get_the_ID(), 'fee_structure', true);
                        $property_count = get_post_meta(get_the_ID(), 'property_count_raw', true);
            ?>
                        <div class="card p-6 hover:shadow-xl transition-shadow">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="mb-4 relative overflow-hidden rounded-lg">
                                    <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
                                </div>
                            <?php endif; ?>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                <a href="<?php the_permalink(); ?>" class="hover:text-primary-600 transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </p>
                            
                            <div class="space-y-3 mb-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 flex items-center">料金体系:</span>
                                    <span class="text-sm font-semibold text-primary-600"><?php echo esc_html($fee_structure); ?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 flex items-center">管理物件数:</span>
                                    <span class="text-sm font-semibold text-secondary-600"><?php echo esc_html($property_count); ?>件</span>
                                </div>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="w-full btn-primary justify-center">
                                詳しく見てみる
                            </a>
                        </div>
            <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
            endif;
            ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="<?php echo esc_url(site_url('/companies')); ?>" class="btn-accent">
                すべての運営会社を見る
            </a>
        </div>
    </div>
</section>

<!-- サービス紹介 -->
<section id="how-it-works" class="py-16 bg-gray-50 border-y border-gray-200">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">民泊運営代行サービスについて</h2>
            <p class="text-lg text-gray-600">運営代行会社が提供する主要なサービス内容</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="card p-8 hover:shadow-lg transition-shadow">
                    <div class="bg-primary-100 w-20 h-20 rounded-lg flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">物件管理</h3>
                    <p class="text-gray-600 leading-relaxed">
                        清掃・メンテナンス・鍵の管理など、<br>
                        物件管理に必要な業務を包括的にサポート
                    </p>
                </div>
            </div>
            
            <div class="text-center">
                <div class="card p-8 hover:shadow-lg transition-shadow">
                    <div class="bg-secondary-100 w-20 h-20 rounded-lg flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">ゲスト対応</h3>
                    <p class="text-gray-600 leading-relaxed">
                        24時間365日の多言語対応。<br>
                        チェックイン・問い合わせ対応を一括サポート
                    </p>
                </div>
            </div>
            
            <div class="text-center">
                <div class="card p-8 hover:shadow-lg transition-shadow">
                    <div class="bg-warm-100 w-20 h-20 rounded-lg flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">収益最適化</h3>
                    <p class="text-gray-600 leading-relaxed">
                        データ分析・価格設定・マーケティング。<br>
                        収益向上のための戦略的サポート
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 統計セクション -->
<section class="py-16 gradient-warm text-white">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <svg class="w-12 h-12 text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold mb-4">実績データ</h2>
            <p class="text-xl opacity-90">当サイト掲載企業の統計情報</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 text-center">
            <div class="card bg-white/10 backdrop-blur-sm border-white/20 p-4 md:p-6">
                <div class="text-2xl md:text-4xl font-bold mb-1 md:mb-2">150+</div>
                <div class="text-sm md:text-lg opacity-90">掲載中の運営会社</div>
            </div>
            <div class="card bg-white/10 backdrop-blur-sm border-white/20 p-4 md:p-6">
                <div class="text-2xl md:text-4xl font-bold mb-1 md:mb-2">5,000+</div>
                <div class="text-sm md:text-lg opacity-90">総管理物件数</div>
            </div>
            <div class="card bg-white/10 backdrop-blur-sm border-white/20 p-4 md:p-6">
                <div class="text-2xl md:text-4xl font-bold mb-1 md:mb-2">95%</div>
                <div class="text-sm md:text-lg opacity-90">平均満足度</div>
            </div>
            <div class="card bg-white/10 backdrop-blur-sm border-white/20 p-4 md:p-6">
                <div class="text-2xl md:text-4xl font-bold mb-1 md:mb-2">24/7</div>
                <div class="text-sm md:text-lg opacity-90">24時間対応可能な会社数</div>
            </div>
        </div>
    </div>
</section>

<!-- 最新記事 -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">最新情報</h2>
            <p class="text-lg text-gray-600">民泊運営に関するニュース・ノウハウ記事</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $latest_posts = new WP_Query(array(
                'posts_per_page' => 3
            ));
            
            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) : $latest_posts->the_post();
            ?>
                    <article class="card overflow-hidden hover:shadow-xl transition-shadow">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="relative overflow-hidden">
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
                                <div class="absolute top-3 left-3">
                                    <span class="bg-primary-600 text-white px-3 py-1.5 rounded-md text-xs font-semibold uppercase tracking-wide">
                                        New
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2 flex items-center">
                                <?php echo get_the_date(); ?>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                <a href="<?php the_permalink(); ?>" class="hover:text-primary-600 transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                                続きを読む →
                            </a>
                        </div>
                    </article>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="<?php echo esc_url(site_url('/category/columns')); ?>" class="btn-secondary">
                すべての記事を見る
            </a>
        </div>
    </div>
</section>

<!-- CTA セクション -->
<section class="py-16 gradient-warm text-white">
    <div class="max-w-4xl mx-auto px-2 sm:px-6 lg:px-8 text-center">
        <div class="mb-6">
            <svg class="w-16 h-16 text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h2 class="text-2xl md:text-3xl font-bold mb-4">民泊運営代行会社をお探しですか？</h2>
        <p class="text-lg md:text-xl mb-6 md:mb-8 opacity-90 leading-relaxed">
            全国の運営代行会社を比較検討し、<br class="hidden md:block">
            最適なパートナーを見つけることができます。
        </p>
        <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
            <a href="<?php echo esc_url(site_url('/companies')); ?>" class="btn-primary text-sm md:text-base">
                運営会社を検索
            </a>
            <a href="<?php echo esc_url(site_url('/contact')); ?>" class="btn-secondary text-sm md:text-base">
                お問い合わせ
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?> 