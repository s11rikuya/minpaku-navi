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
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800">
                        <!-- パターン背景 -->
                        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
                        <!-- デフォルト背景用のアイコン -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-white/20 text-8xl">🏨</div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- 施設情報オーバーレイ -->
                <div class="absolute bottom-0 left-0 right-0 px-2 sm:px-6 pb-4 sm:pb-6 z-20">
                    <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 border border-white/20 max-w-4xl mx-auto">
                        <div class="text-center md:text-left">
                            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 break-words">
                                <?php the_title(); ?>
                            </h1>
                            <?php 
                            $hotel_type = get_post_meta(get_the_ID(), 'hotel_type', true);
                            $hotel_prefecture = get_post_meta(get_the_ID(), 'hotel_prefecture', true);
                            ?>
                            <?php if ($hotel_type || $hotel_prefecture) : ?>
                                <div class="mt-2 flex flex-wrap gap-2 justify-center md:justify-start">
                                    <?php if ($hotel_type) : ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            <?php echo esc_html($hotel_type); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ($hotel_prefecture) : ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <?php echo esc_html($hotel_prefecture); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- メインコンテンツ -->
            <div class="mt-8 px-4 sm:px-6 pb-12">
                <!-- 施設説明 -->
                <?php if (get_the_content()) : ?>
                    <div class="max-w-none mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">施設について</h2>
                        <div class="prose max-w-none">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- 施設画像ギャラリー -->
                <?php
                $gallery_images = get_post_meta(get_the_ID(), 'hotel_gallery', true);
                $valid_images = array(); // 変数を最初に初期化
                
                // デバッグ情報（管理者のみ表示）
                if (current_user_can('manage_options')) {
                    echo '<!-- デバッグ: gallery_images = ';
                    print_r($gallery_images);
                    echo ' | is_array: ' . (is_array($gallery_images) ? 'Yes' : 'No');
                    echo ' | empty: ' . (empty($gallery_images) ? 'Yes' : 'No');
                    
                    if (is_array($gallery_images)) {
                        echo ' | Image URLs: ';
                        foreach ($gallery_images as $img_id) {
                            $url = wp_get_attachment_url($img_id);
                            echo 'ID:' . $img_id . '=' . ($url ? $url : 'NOT_FOUND') . ', ';
                        }
                    }
                    echo ' -->';
                }
                
                // 有効な画像を収集
                if ($gallery_images && is_array($gallery_images) && !empty($gallery_images)) {
                    foreach ($gallery_images as $image_id) {
                        $image_url = wp_get_attachment_url($image_id);
                        if ($image_id && $image_url) {
                            $valid_images[] = $image_id;
                        }
                    }
                    
                    // さらにデバッグ
                    if (current_user_can('manage_options')) {
                        echo '<!-- Valid images count: ' . count($valid_images) . ' -->';
                        echo '<!-- valid_images array: ';
                        print_r($valid_images);
                        echo ' -->';
                    }
                }
                ?>
                
                <?php if (!empty($valid_images)) : ?>
                    <!-- ギャラリー表示開始 -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">施設写真 (<?php echo count($valid_images); ?>枚)</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <?php foreach ($valid_images as $image_id) : ?>
                                <?php 
                                $image_url = wp_get_attachment_url($image_id);
                                if (current_user_can('manage_options')) {
                                    echo '<!-- Rendering image ID: ' . $image_id . ', URL: ' . $image_url . ' -->';
                                }
                                ?>
                                <a href="<?php echo esc_url($image_url); ?>" 
                                   class="gallery-item group block relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-shadow"
                                   data-lightbox="hotel-gallery">
                                    <div class="aspect-w-4 aspect-h-3 relative pb-[75%]">
                                        <img src="<?php echo esc_url($image_url); ?>" 
                                             alt="<?php echo esc_attr(get_the_title()); ?>の写真" 
                                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                             loading="lazy">
                                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- ギャラリー表示終了 -->

                    <!-- Lightbox用のスタイルとスクリプト -->
                    <style>
                        .lightbox {
                            display: none;
                            position: fixed;
                            z-index: 999;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background-color: rgba(0, 0, 0, 0.9);
                            align-items: center;
                            justify-content: center;
                        }
                        .lightbox.active {
                            display: flex;
                        }
                        .lightbox img {
                            max-width: 90%;
                            max-height: 90%;
                            object-fit: contain;
                        }
                        .lightbox-close {
                            position: absolute;
                            top: 20px;
                            right: 30px;
                            color: white;
                            font-size: 40px;
                            font-weight: bold;
                            cursor: pointer;
                            z-index: 1000;
                        }
                        .lightbox-nav {
                            position: absolute;
                            top: 50%;
                            transform: translateY(-50%);
                            color: white;
                            font-size: 40px;
                            font-weight: bold;
                            cursor: pointer;
                            padding: 20px;
                            user-select: none;
                        }
                        .lightbox-prev {
                            left: 20px;
                        }
                        .lightbox-next {
                            right: 20px;
                        }
                    </style>

                    <div id="lightbox" class="lightbox">
                        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
                        <span class="lightbox-nav lightbox-prev" onclick="changeImage(-1)">&#10094;</span>
                        <img id="lightbox-img" src="" alt="">
                        <span class="lightbox-nav lightbox-next" onclick="changeImage(1)">&#10095;</span>
                    </div>

                    <script>
                        var currentImageIndex = 0;
                        var images = [];

                        document.addEventListener('DOMContentLoaded', function() {
                            var galleryItems = document.querySelectorAll('.gallery-item');
                            
                            galleryItems.forEach(function(item, index) {
                                images.push(item.href);
                                
                                item.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    currentImageIndex = index;
                                    openLightbox(item.href);
                                });
                            });
                        });

                        function openLightbox(src) {
                            document.getElementById('lightbox').classList.add('active');
                            document.getElementById('lightbox-img').src = src;
                            document.body.style.overflow = 'hidden';
                        }

                        function closeLightbox() {
                            document.getElementById('lightbox').classList.remove('active');
                            document.body.style.overflow = 'auto';
                        }

                        function changeImage(direction) {
                            currentImageIndex += direction;
                            
                            if (currentImageIndex < 0) {
                                currentImageIndex = images.length - 1;
                            } else if (currentImageIndex >= images.length) {
                                currentImageIndex = 0;
                            }
                            
                            document.getElementById('lightbox-img').src = images[currentImageIndex];
                        }

                        // ESCキーで閉じる
                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape') {
                                closeLightbox();
                            } else if (e.key === 'ArrowLeft') {
                                changeImage(-1);
                            } else if (e.key === 'ArrowRight') {
                                changeImage(1);
                            }
                        });

                        // 背景クリックで閉じる
                        document.getElementById('lightbox').addEventListener('click', function(e) {
                            if (e.target === this) {
                                closeLightbox();
                            }
                        });
                    </script>
                <?php endif; ?>
                
                <?php 
                // 画像が登録されていない場合の表示
                if (empty($valid_images) && current_user_can('edit_posts')) : 
                ?>
                    <div class="mb-12 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="text-sm font-semibold text-yellow-900 mb-1">施設写真が登録されていません</h3>
                                <p class="text-sm text-yellow-700">
                                    管理画面から施設写真を追加してください。<br>
                                    編集画面の「施設画像ギャラリー」セクションから画像を追加できます。
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- 施設情報グリッド -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- 基本情報 -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">基本情報</h2>
                        
                        <div class="space-y-4">
                            <?php
                            $hotel_address = get_post_meta(get_the_ID(), 'hotel_address', true);
                            $hotel_tel = get_post_meta(get_the_ID(), 'hotel_tel', true);
                            $check_in_time = get_post_meta(get_the_ID(), 'check_in_time', true);
                            $check_out_time = get_post_meta(get_the_ID(), 'check_out_time', true);
                            $room_count = get_post_meta(get_the_ID(), 'room_count', true);

                            if ($hotel_address) {
                                echo '<div class="flex items-start py-3 border-b border-gray-200">';
                                echo '<span class="text-sm font-medium text-gray-500 w-32 flex-shrink-0">住所</span>';
                                echo '<span class="text-sm text-gray-900 ml-2">' . esc_html($hotel_address) . '</span>';
                                echo '</div>';
                            }

                            if ($hotel_tel) {
                                echo '<div class="flex items-start py-3 border-b border-gray-200">';
                                echo '<span class="text-sm font-medium text-gray-500 w-32 flex-shrink-0">電話番号</span>';
                                echo '<a href="tel:' . esc_attr(str_replace(array('-', ' ', '(', ')'), '', $hotel_tel)) . '" class="text-sm text-primary-600 hover:text-primary-700 ml-2">' . esc_html($hotel_tel) . '</a>';
                                echo '</div>';
                            }

                            if ($room_count) {
                                echo '<div class="flex items-start py-3 border-b border-gray-200">';
                                echo '<span class="text-sm font-medium text-gray-500 w-32 flex-shrink-0">部屋数</span>';
                                echo '<span class="text-sm text-gray-900 ml-2">' . esc_html($room_count) . ' 室</span>';
                                echo '</div>';
                            }

                            if ($check_in_time) {
                                echo '<div class="flex items-start py-3 border-b border-gray-200">';
                                echo '<span class="text-sm font-medium text-gray-500 w-32 flex-shrink-0">チェックイン</span>';
                                echo '<span class="text-sm text-gray-900 ml-2">' . esc_html($check_in_time) . '</span>';
                                echo '</div>';
                            }

                            if ($check_out_time) {
                                echo '<div class="flex items-start py-3 border-b border-gray-200 last:border-0">';
                                echo '<span class="text-sm font-medium text-gray-500 w-32 flex-shrink-0">チェックアウト</span>';
                                echo '<span class="text-sm text-gray-900 ml-2">' . esc_html($check_out_time) . '</span>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- 料金情報 -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">料金情報</h2>
                        <?php
                        $price_range_min = get_post_meta(get_the_ID(), 'price_range_min', true);
                        $price_range_max = get_post_meta(get_the_ID(), 'price_range_max', true);
                        ?>
                        
                        <?php if ($price_range_min || $price_range_max) : ?>
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-500 mb-2">1泊あたりの料金範囲</p>
                                <div class="text-3xl font-bold text-primary-600">
                                    <?php if ($price_range_min && $price_range_max) : ?>
                                        ¥<?php echo number_format($price_range_min); ?> 〜 ¥<?php echo number_format($price_range_max); ?>
                                    <?php elseif ($price_range_min) : ?>
                                        ¥<?php echo number_format($price_range_min); ?>〜
                                    <?php elseif ($price_range_max) : ?>
                                        〜¥<?php echo number_format($price_range_max); ?>
                                    <?php endif; ?>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">※料金は時期により変動する場合があります</p>
                            </div>
                        <?php else : ?>
                            <p class="text-sm text-gray-500">料金情報はお問い合わせください</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 設備・アメニティ -->
                <?php
                $amenities = get_post_meta(get_the_ID(), 'amenities', true);
                if ($amenities && is_array($amenities) && !empty($amenities)) :
                ?>
                    <div class="bg-gray-50 rounded-xl p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">設備・アメニティ</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            <?php foreach ($amenities as $amenity) : ?>
                                <div class="flex items-center bg-white px-3 py-2 rounded-lg border border-gray-200">
                                    <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm text-gray-700"><?php echo esc_html($amenity); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- お問い合わせ・アクション -->
                <div class="bg-primary-50 rounded-xl p-6">
                    <div class="text-center">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">この施設にお問い合わせ</h2>
                        <p class="text-gray-600 mb-6">
                            <?php echo esc_html(get_the_title()); ?>に関するご質問や<br>
                            宿泊プランの詳細についてお問い合わせください
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <?php
                            $contact_params = array(
                                'subject' => '【' . get_the_title() . '】お問い合わせ',
                                'hotel_id' => get_the_ID(),
                                'hotel_name' => get_the_title(),
                                'ref_type' => 'hotel',
                                'ref_url' => get_permalink()
                            );
                            ?>
                            <a href="<?php echo esc_url(add_query_arg($contact_params, site_url('/contact'))); ?>" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-medium">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                お問い合わせする
                            </a>
                            <?php 
                            $hotel_url = get_post_meta(get_the_ID(), 'hotel_url', true);
                            if ($hotel_url) :
                            ?>
                                <a href="<?php echo esc_url($hotel_url); ?>" 
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center justify-center px-6 py-3 bg-white text-primary-600 border-2 border-primary-600 rounded-lg hover:bg-primary-50 transition-colors font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                                    </svg>
                                    公式サイトへ
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>

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
                    <?php
                    $correction_params = array(
                        'subject' => '【' . get_the_title() . '】情報修正依頼',
                        'hotel_id' => get_the_ID(),
                        'hotel_name' => get_the_title(),
                        'ref_type' => 'hotel',
                        'ref_url' => get_permalink()
                    );
                    ?>
                    <a href="<?php echo esc_url(add_query_arg($correction_params, site_url('/contact'))); ?>" 
                       class="btn-primary w-full justify-center text-sm md:text-base">
                        修正依頼をする
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
                        あなたの宿泊施設も当サイトに<br>
                        掲載しませんか？無料でご相談可能です
                    </p>
                    <a href="<?php echo esc_url(site_url('/contact')); ?>?subject=<?php echo urlencode('宿泊施設掲載依頼'); ?>" 
                       class="btn-secondary w-full justify-center text-sm md:text-base">
                        🚀 掲載依頼をする
                    </a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>

