<?php
/**
 * 宿泊施設カードテンプレートパーツ
 */

if (!defined('ABSPATH')) {
    exit;
}

// 投稿データを確認
if (!isset($post) || $post->post_type !== 'hotel') {
    return;
}

// カスタムフィールドを取得
$hotel_data = array(
    'hotel_type' => get_post_meta(get_the_ID(), 'hotel_type', true),
    'hotel_prefecture' => get_post_meta(get_the_ID(), 'hotel_prefecture', true),
    'hotel_address' => get_post_meta(get_the_ID(), 'hotel_address', true),
    'price_range_min' => get_post_meta(get_the_ID(), 'price_range_min', true),
    'price_range_max' => get_post_meta(get_the_ID(), 'price_range_max', true),
    'room_count' => get_post_meta(get_the_ID(), 'room_count', true),
    'amenities' => get_post_meta(get_the_ID(), 'amenities', true)
);

?>

<article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
    
    <!-- 施設画像 -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="relative h-48 md:h-56 overflow-hidden">
            <a href="<?php the_permalink(); ?>" class="block">
                <?php the_post_thumbnail('medium_large', [
                    'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300',
                    'alt'   => get_the_title() . 'の画像'
                ]); ?>
            </a>
            <!-- タイプバッジ -->
            <?php if ($hotel_data['hotel_type']) : ?>
                <div class="absolute top-3 left-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/90 text-gray-800 backdrop-blur-sm">
                        <?php echo esc_html($hotel_data['hotel_type']); ?>
                    </span>
                </div>
            <?php endif; ?>
            <!-- 都道府県バッジ -->
            <?php if ($hotel_data['hotel_prefecture']) : ?>
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500/90 text-white backdrop-blur-sm">
                        <?php echo esc_html($hotel_data['hotel_prefecture']); ?>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="p-4 md:p-6">
        
        <!-- 施設名 -->
        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-3 hover:text-primary-600 transition-colors">
            <a href="<?php the_permalink(); ?>" class="block">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- 料金表示 -->
        <?php if ($hotel_data['price_range_min'] || $hotel_data['price_range_max']) : ?>
            <div class="mb-4 p-3 bg-primary-50 rounded-lg">
                <p class="text-xs text-gray-500 mb-1">1泊あたり</p>
                <div class="text-xl font-bold text-primary-600">
                    <?php if ($hotel_data['price_range_min'] && $hotel_data['price_range_max']) : ?>
                        ¥<?php echo number_format($hotel_data['price_range_min']); ?> 〜 ¥<?php echo number_format($hotel_data['price_range_max']); ?>
                    <?php elseif ($hotel_data['price_range_min']) : ?>
                        ¥<?php echo number_format($hotel_data['price_range_min']); ?>〜
                    <?php elseif ($hotel_data['price_range_max']) : ?>
                        〜¥<?php echo number_format($hotel_data['price_range_max']); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 基本情報 -->
        <div class="space-y-2 mb-4">
            
            <?php if ($hotel_data['hotel_address']) : ?>
                <div class="flex items-start text-sm">
                    <svg class="w-4 h-4 text-gray-400 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-600 line-clamp-2">
                        <?php echo esc_html($hotel_data['hotel_address']); ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if ($hotel_data['room_count']) : ?>
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 text-gray-400 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span class="text-gray-600">
                        <?php echo esc_html($hotel_data['room_count']); ?> 室
                    </span>
                </div>
            <?php endif; ?>

        </div>

        <!-- アメニティアイコン表示 -->
        <?php if ($hotel_data['amenities'] && is_array($hotel_data['amenities']) && !empty($hotel_data['amenities'])) : ?>
            <div class="mb-4 pt-3 border-t border-gray-100">
                <p class="text-xs text-gray-500 mb-2">設備・アメニティ</p>
                <div class="flex flex-wrap gap-1">
                    <?php 
                    $display_amenities = array_slice($hotel_data['amenities'], 0, 5);
                    foreach ($display_amenities as $amenity) : 
                    ?>
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 text-gray-700">
                            <?php echo esc_html($amenity); ?>
                        </span>
                    <?php endforeach; ?>
                    <?php if (count($hotel_data['amenities']) > 5) : ?>
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 text-gray-700">
                            +<?php echo count($hotel_data['amenities']) - 5; ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- 詳細リンク -->
        <div class="text-center mt-4">
            <a href="<?php the_permalink(); ?>" 
               class="btn-primary w-full text-sm md:text-base inline-flex items-center justify-center">
                詳細を見る
                <svg class="ml-1 md:ml-2 -mr-1 w-3 h-3 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
    </div>
</article>

