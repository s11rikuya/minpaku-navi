<?php
/**
 * 運営会社検索フォーム
 */

if (!defined('ABSPATH')) {
    exit;
}

// 現在の検索条件を取得
$current_area = isset($_GET['area']) ? sanitize_text_field($_GET['area']) : '';
$current_fee = isset($_GET['fee']) ? sanitize_text_field($_GET['fee']) : '';
$current_service = isset($_GET['service']) ? sanitize_text_field($_GET['service']) : '';
$current_keyword = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$current_sort = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : '';

// エリアオプションを取得
$area_options = get_area_options_for_search();
?>

<div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
    <form method="get" action="<?php echo get_post_type_archive_link('company'); ?>" class="space-y-6">
        
        <!-- タイトル -->
        <div class="text-center mb-6">
            <div class="flex items-center justify-center mb-3">
                <svg class="w-6 h-6 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-900">運営会社を検索</h2>
            </div>
            <p class="text-gray-600 text-sm">条件を指定して、最適な運営会社を見つけましょう</p>
        </div>

        <!-- フリーワード検索 -->
        <div class="relative">
            <label for="keyword-search" class="block text-sm font-semibold text-gray-700 mb-2">
                キーワード検索
            </label>
            <div class="relative">
                <input 
                    type="text" 
                    id="keyword-search"
                    name="s" 
                    value="<?php echo esc_attr($current_keyword); ?>"
                    placeholder="会社名やサービスで検索..." 
                    class="w-full px-4 py-3 pl-12 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                >
                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- 詳細検索トグルボタン -->
        <div class="text-center">
            <button 
                type="button"
                id="toggle-advanced-search"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-primary-600 hover:text-primary-700 focus:outline-none"
            >
                <svg id="toggle-icon-down" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <svg id="toggle-icon-up" class="w-5 h-5 mr-2 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
                <span id="toggle-text">詳細検索を表示</span>
            </button>
        </div>

        <!-- 詳細検索（折りたたみ） -->
        <div id="advanced-search" class="hidden">
            <div class="border-t border-gray-200 pt-6 space-y-6">
                
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            
            <!-- 対応エリア -->
            <div>
                <label for="area-select" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    対応エリア
                </label>
                <select 
                    name="area" 
                    id="area-select"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                >
                    <option value="">全国</option>
                    
                    <optgroup label="主要都市">
                        <?php foreach ($area_options['major'] as $key => $label) : ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_area, $key); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    
                    <optgroup label="東北地方">
                        <?php foreach ($area_options['tohoku'] as $key => $label) : ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_area, $key); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    
                    <optgroup label="関東地方（その他）">
                        <?php foreach ($area_options['kanto'] as $key => $label) : ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_area, $key); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    
                    <optgroup label="中部地方">
                        <?php foreach ($area_options['chubu'] as $key => $label) : ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_area, $key); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    
                    <optgroup label="関西地方（その他）">
                        <?php foreach ($area_options['kansai'] as $key => $label) : ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_area, $key); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    
                    <optgroup label="中国地方">
                        <?php foreach ($area_options['chugoku'] as $key => $label) : ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_area, $key); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    
                    <optgroup label="四国地方">
                        <?php foreach ($area_options['shikoku'] as $key => $label) : ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_area, $key); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                    
                    <optgroup label="九州・沖縄地方">
                        <?php foreach ($area_options['kyushu'] as $key => $label) : ?>
                            <option value="<?php echo esc_attr($key); ?>" <?php selected($current_area, $key); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                </select>
            </div>

            <!-- 料金帯 -->
            <div>
                <label for="fee-select" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    料金帯
                </label>
                <select 
                    name="fee" 
                    id="fee-select"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                >
                    <option value="">すべての料金帯</option>
                    <option value="low" <?php selected($current_fee, 'low'); ?>>〜10%（低価格）</option>
                    <option value="middle" <?php selected($current_fee, 'middle'); ?>>11%〜15%（標準）</option>
                    <option value="high" <?php selected($current_fee, 'high'); ?>>16%〜（プレミアム）</option>
                </select>
            </div>

            <!-- サービス特徴 -->
            <div>
                <label for="service-select" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    サービス特徴
                </label>
                <select 
                    name="service" 
                    id="service-select"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                >
                    <option value="">すべてのサービス</option>
                    <option value="cleaning" <?php selected($current_service, 'cleaning'); ?>>清掃込み</option>
                    <option value="24h" <?php selected($current_service, '24h'); ?>>24時間対応</option>
                    <option value="airbnb" <?php selected($current_service, 'airbnb'); ?>>Airbnbパートナー</option>
                </select>
            </div>
        </div>

                <!-- 並び順 -->
                <div class="border-t border-gray-200 pt-4">
                    <label for="sort-select" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                        </svg>
                        並び順
                    </label>
                    <select 
                        name="orderby" 
                        id="sort-select"
                        class="w-full md:w-64 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                    >
                        <option value="">おすすめ順</option>
                        <option value="date" <?php selected($current_sort, 'date'); ?>>新着順</option>
                        <option value="title" <?php selected($current_sort, 'title'); ?>>名前順（あいうえお）</option>
                        <option value="property_count" <?php selected($current_sort, 'property_count'); ?>>管理物件数が多い順</option>
                    </select>
                </div>

                <!-- 検索ヒント -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <div class="text-sm text-gray-700">
                            <strong class="font-semibold">検索のコツ：</strong>
                            複数の条件を組み合わせて、より詳細に絞り込めます。例：「東京都」+「清掃込み」+「〜10%」
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ボタン -->
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <button 
                type="submit" 
                class="flex-1 btn-primary inline-flex items-center justify-center px-6 py-3 text-base font-semibold"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                検索する
            </button>
            <a 
                href="<?php echo get_post_type_archive_link('company'); ?>" 
                class="flex-shrink-0 inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                条件をクリア
            </a>
        </div>
    </form>
</div>

<!-- 折りたたみ機能のJavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggle-advanced-search');
    const advancedSearch = document.getElementById('advanced-search');
    const toggleText = document.getElementById('toggle-text');
    const iconDown = document.getElementById('toggle-icon-down');
    const iconUp = document.getElementById('toggle-icon-up');
    
    // 検索条件が設定されている場合は初期表示
    const urlParams = new URLSearchParams(window.location.search);
    const hasFilters = urlParams.has('area') || urlParams.has('fee') || 
                       urlParams.has('service') || urlParams.has('orderby');
    
    if (hasFilters) {
        advancedSearch.classList.remove('hidden');
        toggleText.textContent = '詳細検索を隠す';
        iconDown.classList.add('hidden');
        iconUp.classList.remove('hidden');
    }
    
    // トグルボタンのクリックイベント
    toggleBtn.addEventListener('click', function() {
        const isHidden = advancedSearch.classList.contains('hidden');
        
        if (isHidden) {
            advancedSearch.classList.remove('hidden');
            toggleText.textContent = '詳細検索を隠す';
            iconDown.classList.add('hidden');
            iconUp.classList.remove('hidden');
            
            // スムーズスクロール
            setTimeout(() => {
                advancedSearch.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        } else {
            advancedSearch.classList.add('hidden');
            toggleText.textContent = '詳細検索を表示';
            iconDown.classList.remove('hidden');
            iconUp.classList.add('hidden');
        }
    });
});
</script>
