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
    
    <!-- 装飾的な要素 -->
    <div class="absolute top-10 md:top-20 left-5 md:left-10 w-16 md:w-20 h-16 md:h-20 bg-white/10 rounded-full blur-xl"></div>
    <div class="absolute bottom-10 md:bottom-20 right-5 md:right-10 w-24 md:w-32 h-24 md:h-32 bg-white/10 rounded-full blur-2xl"></div>
    <div class="absolute top-1/3 left-1/4 w-12 md:w-16 h-12 md:h-16 bg-white/10 rounded-full blur-lg"></div>
    
            <div class="relative z-10 max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 flex items-center h-full py-12 md:py-16">
        <div class="text-center w-full">
            <div class="mb-4 md:mb-6 inline-block">
                <span class="inline-flex items-center px-3 py-1.5 md:px-2 md:py-2 bg-white/25 backdrop-blur-md rounded-full text-white text-xs md:text-sm font-medium border border-white/20">
                    民泊運営をわかりやすく、比較しやすく
                </span>
            </div>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 md:mb-6 text-white leading-tight drop-shadow-2xl">
                民泊運営の<br>
                <span class="text-warm-200 drop-shadow-lg">すべてがわかる</span>
            </h1>
            <p class="text-base md:text-xl lg:text-2xl mb-6 md:mb-8 max-w-3xl lg:max-w-4xl mx-auto text-white/95 leading-relaxed drop-shadow-lg px-2">
                民泊運営の始め方から運営会社の選び方まで、わかりやすく解説。<br class="hidden md:block">
                あなたにピッタリの運営パートナーを見つけましょう。
            </p>
            <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center px-2">
                <a href="<?php echo esc_url(site_url('/companies')); ?>" class="btn-primary transform hover:scale-105 shadow-2xl text-sm md:text-base inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    運営会社を調べる
                </a>
                <a href="<?php echo esc_url(site_url('/category/columns')); ?>" class="btn-secondary shadow-2xl backdrop-blur-sm text-sm md:text-base inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    民泊運営について学ぶ
                </a>
            </div>
        </div>
    </div>
    
    <!-- スクロール誘導 -->
    <div class="absolute bottom-4 md:bottom-6 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-5 h-8 md:w-6 md:h-10 border-2 border-white/60 rounded-full flex justify-center backdrop-blur-sm">
            <div class="w-0.5 md:w-1 h-2 md:h-3 bg-white/80 rounded-full mt-1.5 md:mt-2"></div>
        </div>
    </div>
</section>

<!-- 次へのスムーズな移行 -->
<div class="h-4 bg-gradient-to-b from-white/20 to-transparent"></div>

<!-- 検索セクション -->
<section class="py-12 md:py-16 bg-gradient-to-b from-warm-50 to-white">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="text-center mb-8 md:mb-12">
            <div class="inline-block mb-4">
                <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">あなたに合った運営会社を比較しよう</h2>
            <p class="text-base md:text-lg text-gray-600">全国の民泊運営会社を条件で絞り込み、詳しく比較できます</p>
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
                    <select name="area" class="w-full rounded-2xl border-gray-200 focus:border-primary-400 focus:ring-primary-400 transition-colors">
                        <option value="">どこでも大丈夫</option>
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
                            'shikoku' => '🌊 四国地方',
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
                    <select name="fee" class="w-full rounded-2xl border-gray-200 focus:border-primary-400 focus:ring-primary-400 transition-colors">
                        <option value="">予算はお任せ</option>
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
                    <select name="service" class="w-full rounded-2xl border-gray-200 focus:border-primary-400 focus:ring-primary-400 transition-colors">
                        <option value="">何でもOK</option>
                        <option value="cleaning">清掃込み</option>
                        <option value="24h">24時間対応</option>
                        <option value="airbnb">Airbnbパートナー</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="w-full btn-primary transform hover:scale-105">
                        🚀 検索スタート
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- おすすめ運営会社 -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <svg class="w-12 h-12 text-yellow-500 mx-auto float-animation" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">評価の高い人気運営会社</h2>
            <p class="text-lg text-gray-600">実績豊富で評判の良い運営会社をご紹介</p>
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
                    <div class="card p-6">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="mb-4 relative overflow-hidden rounded-2xl">
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover transition-transform duration-300 hover:scale-105']); ?>
                                <div class="absolute top-3 right-3">
                                    <span class="bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full text-xs font-medium text-primary-600">
                                        おすすめ
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
                            😊 詳しく見てみる
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
                        <div class="card p-6">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="mb-4 relative overflow-hidden rounded-2xl">
                                    <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover transition-transform duration-300 hover:scale-105']); ?>
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
                                😊 詳しく見てみる
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
                🌈 すべての運営会社を見る
            </a>
        </div>
    </div>
</section>

<!-- サービス紹介 -->
<section id="how-it-works" class="py-16 bg-gradient-to-b from-secondary-50 to-primary-50">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">民泊運営代行サービスとは？</h2>
            <p class="text-lg text-gray-600">民泊運営に必要な業務とサービス内容をわかりやすく解説</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="card p-8">
                    <div class="bg-primary-100 w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-6 float-animation">
                        <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">物件管理</h3>
                    <p class="text-gray-600 leading-relaxed">
                        清掃やメンテナンス、鍵の受け渡しなど。<br>
                        物件管理に必要な業務内容を詳しく解説
                    </p>
                </div>
            </div>
            
            <div class="text-center">
                <div class="card p-8">
                    <div class="bg-secondary-100 w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-6 float-animation" style="animation-delay: 0.5s;">
                        <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">ゲスト対応</h3>
                    <p class="text-gray-600 leading-relaxed">
                        24時間365日、多言語でのゲストサポート。<br>
                        対応方法や体制について詳しくご紹介 😊
                    </p>
                </div>
            </div>
            
            <div class="text-center">
                <div class="card p-8">
                    <div class="bg-warm-100 w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-6 float-animation" style="animation-delay: 1s;">
                        <svg class="w-12 h-12 text-primary-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">収益最適化</h3>
                    <p class="text-gray-600 leading-relaxed">
                        データ分析とマーケティング手法について。<br>
                        収益向上の仕組みをわかりやすく解説 🚀
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
            <h2 class="text-3xl font-bold mb-4">民泊運営業界の現状</h2>
            <p class="text-xl opacity-90">当サイトで紹介している運営会社の実績データ</p>
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
                <div class="text-sm md:text-lg opacity-90">😊 平均満足度</div>
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
                <span class="text-4xl">📰</span>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">最新情報をお届け</h2>
            <p class="text-lg text-gray-600">民泊運営に役立つ、ためになる情報満載</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            $latest_posts = new WP_Query(array(
                'posts_per_page' => 3
            ));
            
            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) : $latest_posts->the_post();
            ?>
                    <article class="card overflow-hidden">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="relative overflow-hidden">
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover transition-transform duration-300 hover:scale-105']); ?>
                                <div class="absolute top-3 left-3">
                                    <span class="bg-primary-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                        新着
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
                📚 すべての記事を見る
            </a>
        </div>
    </div>
</section>

<!-- CTA セクション -->
<section class="py-16 gradient-warm text-white">
    <div class="max-w-4xl mx-auto px-2 sm:px-6 lg:px-8 text-center">
        <div class="mb-6">
            <span class="text-6xl">🎉</span>
        </div>
        <h2 class="text-2xl md:text-3xl font-bold mb-4">民泊運営を始めてみませんか？</h2>
        <p class="text-lg md:text-xl mb-6 md:mb-8 opacity-90 leading-relaxed">
            運営会社の比較や民泊運営のノウハウをしっかり学んで、<br class="hidden md:block">
            理想的な民泊運営への第一歩を踏み出しましょう。
        </p>
        <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
            <a href="<?php echo esc_url(site_url('/companies')); ?>" class="btn-primary transform hover:scale-105 text-sm md:text-base">
                🚀 運営会社を比較する
            </a>
            <a href="<?php echo esc_url(site_url('/contact')); ?>" class="btn-secondary text-sm md:text-base">
                💌 情報について問い合わせる
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?> 