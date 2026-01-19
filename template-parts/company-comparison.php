<?php
/**
 * Template Name: 運営会社比較
 */

get_header();
?>

    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-12">
    <!-- フィルターセクション -->
    <div class="bg-white shadow-sm rounded-xl p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6">条件で絞り込む</h2>
        <form class="grid grid-cols-1 md:grid-cols-3 gap-6" id="company-filter">
            <!-- エリア -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">対応エリア</label>
                <select class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500">
                    <option value="">すべて</option>
                    <option value="東京都">東京都</option>
                    <option value="大阪府">大阪府</option>
                    <option value="京都府">京都府</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="福岡県">福岡県</option>
                </select>
            </div>

            <!-- サービスタイプ -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">サービスタイプ</label>
                <select class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500">
                    <option value="">すべて</option>
                    <option value="フルサービス">フルサービス</option>
                    <option value="部分代行">部分代行</option>
                    <option value="コンサルティング">コンサルティング</option>
                </select>
            </div>

            <!-- サービス特徴 -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">サービス特徴</label>
                <div class="space-y-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" name="services[]" value="cleaning_included">
                        <span class="ml-2 text-sm text-gray-600">清掃込み</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" name="services[]" value="support_24h">
                        <span class="ml-2 text-sm text-gray-600">24時間対応</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" name="services[]" value="airbnb_partner">
                        <span class="ml-2 text-sm text-gray-600">Airbnbパートナー</span>
                    </label>
                </div>
            </div>
        </form>
    </div>

    <!-- 比較テーブル -->
    <div class="bg-white shadow-sm rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">運営会社一覧</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            会社名
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            対応地域
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            サービスタイプ
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            料金体系
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            管理物件数
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            特徴
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">詳細</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $args = array(
                        'post_type' => 'company',
                        'posts_per_page' => -1,
                    );
                    $companies = new WP_Query($args);

                    if ($companies->have_posts()) :
                        while ($companies->have_posts()) : $companies->the_post();
                            $service_type = get_post_meta(get_the_ID(), 'service_type', true);
                            $service_areas = get_post_meta(get_the_ID(), 'service_areas', true);
                            $fee_structure = get_post_meta(get_the_ID(), 'fee_structure', true);
                            $property_count = get_post_meta(get_the_ID(), 'property_count_raw', true);
                            
                            // 特徴フラグ
                            $support_24h = get_post_meta(get_the_ID(), 'support_24h', true);
                            $airbnb_partner = get_post_meta(get_the_ID(), 'airbnb_partner', true);
                            $cleaning_included = get_post_meta(get_the_ID(), 'cleaning_included', true);
                    ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <?php the_post_thumbnail('thumbnail', ['class' => 'h-10 w-10 rounded-full object-cover']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="ml-4">
                                            <a href="<?php the_permalink(); ?>" class="text-sm font-medium text-gray-900 hover:text-primary-600">
                                                <?php the_title(); ?>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?php 
                                    if ($service_areas && is_array($service_areas) && !empty($service_areas)) {
                                        $display_areas = array_slice($service_areas, 0, 2);
                                        echo esc_html(implode('、', $display_areas));
                                        if (count($service_areas) > 2) {
                                            echo ' 等';
                                        }
                                    } else {
                                        echo '未設定';
                                    }
                                    ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $service_type ? esc_html($service_type) : '未設定'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $fee_structure ? esc_html($fee_structure) : '未設定'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $property_count ? esc_html($property_count) . ' 件' : '未設定'; ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="flex flex-wrap gap-1">
                                        <?php if ($support_24h === 'Yes') : ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">24h</span>
                                        <?php endif; ?>
                                        <?php if ($airbnb_partner === 'Yes') : ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Airbnb</span>
                                        <?php endif; ?>
                                        <?php if ($cleaning_included === 'Yes') : ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">清掃</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="<?php the_permalink(); ?>" class="text-primary-600 hover:text-primary-900">詳細</a>
                                </td>
                            </tr>
                    <?php 
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                登録されている運営会社はありません。
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 比較のポイント -->
    <div class="mt-12 bg-gray-50 rounded-xl p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">運営会社を比較するポイント</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">料金体系</h3>
                <p class="text-gray-600">手数料率、初期費用、清掃費用などの料金体系を確認しましょう。総合的なコストを考慮することが重要です。</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">サポート体制</h3>
                <p class="text-gray-600">24時間対応の有無、緊急時の対応、言語対応など、運営時のサポート体制を確認しましょう。</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">実績と信頼性</h3>
                <p class="text-gray-600">管理物件数、運営実績年数、口コミ評価などから、会社の信頼性を判断しましょう。</p>
            </div>
        </div>
    </div>
</div>

<!-- フィルタリングのJavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('company-filter');
    const filters = form.querySelectorAll('select, input[type="checkbox"]');

    filters.forEach(filter => {
        filter.addEventListener('change', function() {
            // ここにフィルタリングのロジックを実装
            console.log('フィルター変更:', this.value);
        });
    });
});
</script>

<?php get_footer(); ?> 