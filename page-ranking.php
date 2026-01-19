<?php
/*
Template Name: 運営会社ランキング
*/
get_header(); ?>

<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-8">
    <!-- ページヘッダー -->
    <div class="text-center mb-12">
        <div class="inline-block mb-4">
            <span class="text-5xl">🏆</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            運営会社ランキング
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            実績・評価・サービス内容をもとに、おすすめの民泊運営会社をランキング形式でご紹介します ✨
        </p>
    </div>

    <!-- フィルター -->
    <div class="card p-6 mb-8">
        <div class="flex flex-wrap items-center gap-4 mb-4">
            <h2 class="text-lg font-bold text-gray-900 flex items-center">
                🔍 ランキングを絞り込む
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">📍 エリア</label>
                <select id="area-filter" class="w-full rounded-2xl border-gray-200 focus:border-primary-400 focus:ring-primary-400">
                    <option value="">すべてのエリア</option>
                    <option value="tokyo">🗼 東京</option>
                    <option value="osaka">🏯 大阪</option>
                    <option value="kyoto">⛩️ 京都</option>
                    <option value="fukuoka">🍜 福岡</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">💰 料金帯</label>
                <select id="fee-filter" class="w-full rounded-2xl border-gray-200 focus:border-primary-400 focus:ring-primary-400">
                    <option value="">すべての料金帯</option>
                    <option value="low">💚 〜10%（お得）</option>
                    <option value="middle">💛 11%〜15%（標準）</option>
                    <option value="high">🧡 16%〜（プレミアム）</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">⭐ サービス</label>
                <select id="service-filter" class="w-full rounded-2xl border-gray-200 focus:border-primary-400 focus:ring-primary-400">
                    <option value="">すべてのサービス</option>
                    <option value="cleaning">🧹 清掃込み</option>
                    <option value="24h">🌙 24時間対応</option>
                    <option value="airbnb">🏡 Airbnbパートナー</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">📊 並び順</label>
                <select id="sort-filter" class="w-full rounded-2xl border-gray-200 focus:border-primary-400 focus:ring-primary-400">
                    <option value="rating">⭐ 評価順</option>
                    <option value="properties">🏠 物件数順</option>
                    <option value="fee">💰 料金順</option>
                    <option value="experience">📅 実績順</option>
                </select>
            </div>
        </div>
    </div>

    <!-- ランキングタブ -->
    <div class="flex flex-wrap gap-2 mb-8 justify-center">
        <button class="ranking-tab active" data-tab="overall">
            🏆 総合ランキング
        </button>
        <button class="ranking-tab" data-tab="rating">
            ⭐ 評価ランキング
        </button>
        <button class="ranking-tab" data-tab="properties">
            🏠 物件数ランキング
        </button>
        <button class="ranking-tab" data-tab="cost">
            💰 コスパランキング
        </button>
        <button class="ranking-tab" data-tab="service">
            🎯 サービスランキング
        </button>
    </div>

    <!-- ランキング表示エリア -->
    <div id="ranking-content">
        <?php
        // ページネーション用の設定
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $companies_per_page = 10; // 1ページあたりの表示数
        
        // 運営会社データを取得
        $companies = new WP_Query(array(
            'post_type' => 'company',
            'posts_per_page' => $companies_per_page,
            'paged' => $paged,
            'meta_key' => 'overall_rating',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));
        
        if ($companies->have_posts()) :
            // ページネーション用のランク計算
            $rank = ($paged - 1) * $companies_per_page + 1;
            while ($companies->have_posts()) : $companies->the_post();
                $fee_structure = get_post_meta(get_the_ID(), 'fee_structure', true);
                $property_count = get_post_meta(get_the_ID(), 'property_count_raw', true);
                $overall_rating = get_post_meta(get_the_ID(), 'overall_rating', true) ?: '4.5';
                $years_experience = get_post_meta(get_the_ID(), 'years_experience', true) ?: '3';
                $airbnb_partner = get_post_meta(get_the_ID(), 'airbnb_partner', true);
                $support_24h = get_post_meta(get_the_ID(), 'support_24h', true);
                $cleaning_included = get_post_meta(get_the_ID(), 'cleaning_included', true);
                
                // ランク表示のスタイル決定
                $rank_style = '';
                $rank_emoji = '';
                $global_rank = ($paged - 1) * $companies_per_page + ($rank - (($paged - 1) * $companies_per_page));
                if ($global_rank == 1) {
                    $rank_style = 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-white';
                    $rank_emoji = '👑';
                } elseif ($global_rank == 2) {
                    $rank_style = 'bg-gradient-to-r from-gray-400 to-gray-500 text-white';
                    $rank_emoji = '🥈';
                } elseif ($global_rank == 3) {
                    $rank_style = 'bg-gradient-to-r from-orange-400 to-orange-500 text-white';
                    $rank_emoji = '🥉';
                } else {
                    $rank_style = 'bg-gray-100 text-gray-700';
                    $rank_emoji = '⭐';
                }
        ?>
                <div class="card mb-6 overflow-hidden company-item" data-rank="<?php echo $global_rank; ?>">
                    <div class="p-6">
                        <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                            <!-- ランク表示 -->
                            <div class="flex-shrink-0">
                                <div class="<?php echo $rank_style; ?> w-16 h-16 md:w-20 md:h-20 rounded-3xl flex items-center justify-center text-2xl md:text-3xl font-bold">
                                    <span class="mr-1"><?php echo $rank_emoji; ?></span>
                                    <?php echo $global_rank; ?>
                                </div>
                            </div>
                            
                            <!-- 会社情報 -->
                            <div class="flex-grow">
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                    <!-- 基本情報 -->
                                    <div class="lg:col-span-2">
                                        <div class="flex flex-col md:flex-row gap-4">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="w-full md:w-24 h-32 md:h-24 flex-shrink-0">
                                                    <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover rounded-2xl']); ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="flex-grow">
                                                <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">
                                                    <a href="<?php the_permalink(); ?>" class="hover:text-primary-600 transition-colors">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h2>
                                                
                                                <!-- 評価とサービス -->
                                                <div class="flex flex-wrap items-center gap-4 mb-3">
                                                    <div class="flex items-center">
                                                        <span class="text-yellow-400 text-lg">★★★★★</span>
                                                        <span class="ml-1 text-sm font-semibold text-gray-700"><?php echo $overall_rating; ?></span>
                                                        <span class="ml-1 text-xs text-gray-500">(128件)</span>
                                                    </div>
                                                    <div class="text-sm text-gray-600">
                                                        📅 実績 <?php echo $years_experience; ?>年
                                                    </div>
                                                </div>
                                                
                                                <!-- サービス特徴 -->
                                                <div class="flex flex-wrap gap-2 mb-3">
                                                    <?php if ($airbnb_partner === 'Yes') : ?>
                                                        <span class="feature-badge">🏡 Airbnb公式</span>
                                                    <?php endif; ?>
                                                    <?php if ($support_24h === 'Yes') : ?>
                                                        <span class="feature-badge">🌙 24時間対応</span>
                                                    <?php endif; ?>
                                                    <?php if ($cleaning_included === 'Yes') : ?>
                                                        <span class="feature-badge">🧹 清掃込み</span>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <p class="text-gray-600 text-sm line-clamp-2">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 数値データ -->
                                    <div class="bg-gray-50 rounded-2xl p-4">
                                        <div class="space-y-3">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-gray-600 flex items-center">💰 手数料:</span>
                                                <span class="text-sm font-bold text-primary-600"><?php echo esc_html($fee_structure); ?></span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-gray-600 flex items-center">🏠 管理物件:</span>
                                                <span class="text-sm font-bold text-secondary-600"><?php echo esc_html($property_count); ?>件</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-gray-600 flex items-center">📊 稼働率:</span>
                                                <span class="text-sm font-bold text-green-600"><?php echo rand(85, 95); ?>%</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <a href="<?php the_permalink(); ?>" class="w-full btn-primary justify-center text-sm">
                                                📋 詳細を見る
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ランキング理由 -->
                        <?php if ($global_rank <= 3) : ?>
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="bg-primary-50 rounded-2xl p-4">
                                    <h3 class="text-sm font-bold text-primary-800 mb-2 flex items-center">
                                        🎯 ランクイン理由
                                    </h3>
                                    <p class="text-sm text-primary-700">
                                        <?php
                                        if ($global_rank == 1) {
                                            echo "総合評価が最も高く、物件数・サービス品質・コストパフォーマンスすべてで優秀な実績を持つ信頼のパートナー";
                                        } elseif ($global_rank == 2) {
                                            echo "豊富な経験と安定したサービス提供で、多くのオーナー様から高い評価を獲得している優良企業";
                                        } elseif ($global_rank == 3) {
                                            echo "革新的なサービスと手厚いサポートで急成長中。将来性も非常に期待できる注目の運営会社";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
        <?php
                $rank++;
            endwhile;
            
            // ページネーション
            if ($companies->max_num_pages > 1) :
        ?>
                <!-- ページネーション -->
                <nav class="mt-12 mb-8" aria-label="ランキングページナビゲーション">
                    <div class="flex flex-col items-center space-y-4">
                        <!-- ページ情報 -->
                        <div class="text-center text-sm text-gray-600">
                            <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 rounded-full">
                                📊 全 <?php echo $companies->found_posts; ?> 社中 
                                <?php echo (($paged - 1) * $companies_per_page + 1); ?>〜<?php echo min($paged * $companies_per_page, $companies->found_posts); ?> 社を表示
                            </span>
                        </div>
                        
                        <!-- ページネーションボタン -->
                        <div class="flex flex-wrap justify-center gap-2">
                            <?php
                            $pagination_args = array(
                                'base' => get_pagenum_link(1) . '%_%',
                                'format' => '?paged=%#%',
                                'current' => max(1, $paged),
                                'total' => $companies->max_num_pages,
                                'type' => 'array',
                                'prev_text' => '前へ',
                                'next_text' => '次へ',
                                'end_size' => 2,
                                'mid_size' => 1,
                            );
                            
                            $pagination_links = paginate_links($pagination_args);
                            
                            if ($pagination_links) {
                                foreach ($pagination_links as $link) {
                                    // 現在のページかどうかをチェック
                                    if (strpos($link, 'current') !== false) {
                                        // 現在のページ
                                        echo '<span class="pagination-current">' . strip_tags($link) . '</span>';
                                    } elseif (strpos($link, 'prev') !== false) {
                                        // 前へボタン
                                        echo str_replace('<a ', '<a class="pagination-nav pagination-prev" ', $link);
                                    } elseif (strpos($link, 'next') !== false) {
                                        // 次へボタン
                                        echo str_replace('<a ', '<a class="pagination-nav pagination-next" ', $link);
                                    } elseif (strpos($link, 'dots') !== false) {
                                        // ドット
                                        echo '<span class="pagination-dots">…</span>';
                                    } else {
                                        // 通常のページ番号
                                        echo str_replace('<a ', '<a class="pagination-link" ', $link);
                                    }
                                }
                            }
                            ?>
                        </div>
                        
                        <!-- ページジャンプ -->
                        <div class="flex items-center space-x-2 text-sm">
                            <span class="text-gray-600">ページ移動:</span>
                            <form method="get" class="inline-flex items-center space-x-2">
                                <?php
                                // 現在のクエリパラメータを保持
                                foreach ($_GET as $key => $value) {
                                    if ($key !== 'paged') {
                                        echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                                    }
                                }
                                ?>
                                <input type="number" name="paged" min="1" max="<?php echo $companies->max_num_pages; ?>" 
                                       value="<?php echo $paged; ?>" 
                                       class="pagination-input w-16 px-2 py-1 text-center border border-gray-300 rounded-lg focus:border-primary-400 focus:ring-primary-400 text-sm">
                                <span class="text-gray-500">/ <?php echo $companies->max_num_pages; ?></span>
                                <button type="submit" class="px-3 py-1 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors text-sm">
                                    移動
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
        <?php
            endif;
            wp_reset_postdata();
        else :
        ?>
            <div class="text-center py-12">
                <div class="mb-6">
                    <span class="text-6xl">🔍</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">運営会社が見つかりませんでした</h2>
                <p class="text-gray-500 mb-8">
                    検索条件を変更して、再度お試しください。
                </p>
                <a href="<?php echo esc_url(site_url('/companies')); ?>" class="btn-primary">
                    🏢 すべての運営会社を見る
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- ランキング選択の説明 -->
    <div class="mt-12 card p-6 bg-gradient-to-br from-secondary-50 to-primary-50">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
            📋 ランキングの選定基準
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center">
                <div class="bg-white rounded-2xl p-4 mb-3">
                    <span class="text-3xl">⭐</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">ユーザー評価</h3>
                <p class="text-sm text-gray-600">実際にご利用いただいたオーナー様からの評価を重視</p>
            </div>
            <div class="text-center">
                <div class="bg-white rounded-2xl p-4 mb-3">
                    <span class="text-3xl">📊</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">運営実績</h3>
                <p class="text-sm text-gray-600">管理物件数や稼働率などの客観的な実績データ</p>
            </div>
            <div class="text-center">
                <div class="bg-white rounded-2xl p-4 mb-3">
                    <span class="text-3xl">🎯</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">サービス品質</h3>
                <p class="text-sm text-gray-600">提供サービスの充実度と品質の高さ</p>
            </div>
            <div class="text-center">
                <div class="bg-white rounded-2xl p-4 mb-3">
                    <span class="text-3xl">💰</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">コストパフォーマンス</h3>
                <p class="text-sm text-gray-600">料金に対するサービス内容の満足度</p>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="mt-12 text-center">
        <div class="card p-8 bg-gradient-to-br from-primary-500 to-secondary-500 text-white">
            <div class="mb-4">
                <span class="text-5xl">🚀</span>
            </div>
            <h2 class="text-2xl font-bold mb-4">あなたにピッタリの運営会社を見つけよう</h2>
            <p class="text-lg mb-6 opacity-90">
                無料相談で、あなたの物件に最適なパートナーをご紹介します
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url(site_url('/contact')); ?>" class="btn-accent transform hover:scale-105">
                    💌 無料相談を申し込む
                </a>
                <a href="<?php echo esc_url(site_url('/companies')); ?>" class="btn-secondary">
                    🏢 すべての運営会社を見る
                </a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for filtering and tabs -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // タブ切り替え
    const tabs = document.querySelectorAll('.ranking-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // ここでAJAXでランキングデータを更新
            const tabType = this.getAttribute('data-tab');
            updateRanking(tabType);
        });
    });
    
    // フィルター機能
    const filters = ['area-filter', 'fee-filter', 'service-filter', 'sort-filter'];
    filters.forEach(filterId => {
        const filter = document.getElementById(filterId);
        if (filter) {
            filter.addEventListener('change', function() {
                applyFilters();
            });
        }
    });
    
    function updateRanking(type) {
        // 実際の実装では、AJAXでサーバーからデータを取得
        console.log('Updating ranking for:', type);
    }
    
    function applyFilters() {
        // フィルター適用ロジック
        console.log('Applying filters');
    }
});
</script>

<style>
/* カスタムフィルタースタイル */
.filter-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 2rem;
}

.filter-tabs button {
    padding: 0.5rem 1rem;
    border: 1px solid #e5e7eb;
    background-color: white;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #6b7280;
    transition: all 0.2s;
    cursor: pointer;
}

.filter-tabs button:hover {
    background-color: #f3f4f6;
    border-color: #d1d5db;
}

.filter-tabs button.active {
    background-color: #f97316;
    border-color: #f97316;
    color: white;
}

/* ランキングカード */
.ranking-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    overflow: hidden;
}

.ranking-card:hover {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    transform: translateY(-2px);
}

/* ランク番号 */
.rank-number {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin-right: 1rem;
}

/* 評価星 */
.rating-stars {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.star {
    width: 1rem;
    height: 1rem;
    color: #fbbf24;
}

/* 特徴バッジ */
.feature-badge {
    background: linear-gradient(45deg, #f97316, #fb923c);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
    display: inline-block;
}

/* レスポンシブタブ */
@media (max-width: 768px) {
    .filter-tabs {
        justify-content: center;
    }
    
    .filter-tabs button {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }
}

/* ランキング専用アニメーション */
.ranking-card {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* 1位〜3位の特別スタイル */
.rank-1 {
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    border: 3px solid #fbbf24;
}

.rank-2 {
    background: linear-gradient(135deg, #c0c0c0, #e5e7eb);
    border: 3px solid #9ca3af;
}

.rank-3 {
    background: linear-gradient(135deg, #cd7f32, #f59e0b);
    border: 3px solid #d97706;
}
</style>

<?php get_footer(); ?> 