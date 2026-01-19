<?php
/**
 * 運営会社カードテンプレートパーツ
 */

if (!defined('ABSPATH')) {
    exit;
}

// 投稿データを確認
if (!isset($post) || $post->post_type !== 'company') {
    return;
}

// カスタムフィールドを取得
$company_data = array(
    'service_type' => get_post_meta(get_the_ID(), 'service_type', true),
    'service_areas' => get_post_meta(get_the_ID(), 'service_areas', true),
    'fee_structure' => get_post_meta(get_the_ID(), 'fee_structure', true),
    'property_count' => get_post_meta(get_the_ID(), 'property_count_raw', true),
    'support_24h' => get_post_meta(get_the_ID(), 'support_24h', true),
    'airbnb_partner' => get_post_meta(get_the_ID(), 'airbnb_partner', true),
    'cleaning_included' => get_post_meta(get_the_ID(), 'cleaning_included', true)
);


?>

<article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <div class="p-4 md:p-6">
        
        <!-- 会社ロゴ -->
        <?php if (has_post_thumbnail()) : ?>
    <div class="mb-3 md:mb-4">
        <a href="<?php the_permalink(); ?>" class="block">
            <div class="h-24 md:h-32 w-full overflow-hidden rounded-md bg-gray-50 shadow-md ring-1 ring-gray-200">
                <?php the_post_thumbnail('full', [
                    'class' => 'block w-full h-full object-cover hover:opacity-90 transition-opacity duration-300',
                    'alt'   => get_the_title() . 'の画像'
                ]); ?>
            </div>
        </a>
    </div>
<?php endif; ?>


        <!-- 会社名 -->
        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4 hover:text-primary-600 transition-colors">
            <a href="<?php the_permalink(); ?>" class="block">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- 基本情報 -->
        <div class="space-y-2 md:space-y-3 mb-4 md:mb-6">
            
            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-500 w-24 flex-shrink-0">サービス</span>
                <span class="text-sm text-gray-900 ml-2">
                    <?php echo $company_data['service_type'] ? esc_html($company_data['service_type']) : 'データなし'; ?>
                </span>
            </div>

            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-500 w-24 flex-shrink-0">対応地域</span>
                <span class="text-sm text-gray-900 ml-2">
                    <?php 
                    if ($company_data['service_areas'] && is_array($company_data['service_areas']) && !empty($company_data['service_areas'])) {
                        $display_areas = array_slice($company_data['service_areas'], 0, 3);
                        $area_text = implode('、', $display_areas);
                        if (count($company_data['service_areas']) > 3) {
                            $area_text .= '等';
                        }
                        echo esc_html($area_text);
                    } else {
                        echo 'データなし';
                    }
                    ?>
                </span>
            </div>

            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-500 w-24 flex-shrink-0">料金体系</span>
                <span class="text-sm text-gray-900 ml-2">
                    <?php echo $company_data['fee_structure'] ? esc_html($company_data['fee_structure']) : 'データなし'; ?>
                </span>
            </div>

            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-500 w-24 flex-shrink-0">管理物件</span>
                <span class="text-sm text-gray-900 ml-2">
                    <?php echo $company_data['property_count'] ? esc_html($company_data['property_count']) . ' 件' : 'データなし'; ?>
                </span>
            </div>
            
        </div>



        <!-- 詳細リンク -->
        <div class="text-center">
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