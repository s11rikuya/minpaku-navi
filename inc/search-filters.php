<?php
/**
 * 検索フィルタリング機能
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 運営会社の検索フィルタリング機能
 */
function filter_company_query($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('company')) {
        
        $meta_query = array('relation' => 'AND');
        
        // エリアでの絞り込み（配列型カスタムフィールド対応）
        if (!empty($_GET['area'])) {
            $area = sanitize_text_field($_GET['area']);
            
            // area パラメータを都道府県名にマッピング
            $area_mapping = get_area_mapping();
            
            if (isset($area_mapping[$area])) {
                $prefecture = $area_mapping[$area];
                
                // 配列型カスタムフィールドの検索には複数の方法を試す
                $meta_query[] = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'service_areas',
                        'value' => '"' . $prefecture . '"',
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'service_areas',
                        'value' => serialize($prefecture),
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'service_areas',
                        'value' => $prefecture,
                        'compare' => 'LIKE'
                    )
                );
            }
        }
        
        // サービス特徴での絞り込み
        if (!empty($_GET['service'])) {
            $service = sanitize_text_field($_GET['service']);
            $service_meta = get_service_meta_mapping($service);
            
            if ($service_meta) {
                $meta_query[] = $service_meta;
            }
        }
        
        // 料金帯での絞り込み
        if (!empty($_GET['fee'])) {
            $fee = sanitize_text_field($_GET['fee']);
            $fee_meta = get_fee_meta_mapping($fee);
            
            if ($fee_meta) {
                $meta_query[] = $fee_meta;
            }
        }
        
        // メタクエリが設定されている場合のみ適用
        if (count($meta_query) > 1) {
            $query->set('meta_query', $meta_query);
        }
        
        // 並び順の設定
        if (!empty($_GET['orderby'])) {
            $orderby = sanitize_text_field($_GET['orderby']);
            
            switch ($orderby) {
                case 'date':
                    $query->set('orderby', 'date');
                    $query->set('order', 'DESC');
                    break;
                
                case 'title':
                    $query->set('orderby', 'title');
                    $query->set('order', 'ASC');
                    break;
                
                case 'property_count':
                    $query->set('meta_key', 'property_count_raw');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;
                
                default:
                    // おすすめ順：メタクエリとランダム性を組み合わせ
                    $query->set('orderby', array(
                        'menu_order' => 'ASC',
                        'date' => 'DESC'
                    ));
                    break;
            }
        } else {
            // デフォルトのおすすめ順
            $query->set('orderby', array(
                'menu_order' => 'ASC',
                'date' => 'DESC'
            ));
        }
        
        // デバッグ: 検索条件をログに出力（開発時のみ）
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('Company Search Debug: ' . print_r(array(
                'area' => $_GET['area'] ?? '',
                'service' => $_GET['service'] ?? '',
                'fee' => $_GET['fee'] ?? '',
                'orderby' => $_GET['orderby'] ?? '',
                's' => $_GET['s'] ?? '',
                'meta_query' => $meta_query
            ), true));
        }
    }
}
add_action('pre_get_posts', 'filter_company_query');

/**
 * エリアマッピングを取得（全47都道府県）
 */
function get_area_mapping() {
    return array(
        'hokkaido' => '北海道',
        'aomori' => '青森県',
        'iwate' => '岩手県',
        'miyagi' => '宮城県',
        'akita' => '秋田県',
        'yamagata' => '山形県',
        'fukushima' => '福島県',
        'ibaraki' => '茨城県',
        'tochigi' => '栃木県',
        'gunma' => '群馬県',
        'saitama' => '埼玉県',
        'chiba' => '千葉県',
        'tokyo' => '東京都',
        'kanagawa' => '神奈川県',
        'niigata' => '新潟県',
        'toyama' => '富山県',
        'ishikawa' => '石川県',
        'fukui' => '福井県',
        'yamanashi' => '山梨県',
        'nagano' => '長野県',
        'gifu' => '岐阜県',
        'shizuoka' => '静岡県',
        'aichi' => '愛知県',
        'mie' => '三重県',
        'shiga' => '滋賀県',
        'kyoto' => '京都府',
        'osaka' => '大阪府',
        'hyogo' => '兵庫県',
        'nara' => '奈良県',
        'wakayama' => '和歌山県',
        'tottori' => '鳥取県',
        'shimane' => '島根県',
        'okayama' => '岡山県',
        'hiroshima' => '広島県',
        'yamaguchi' => '山口県',
        'tokushima' => '徳島県',
        'kagawa' => '香川県',
        'ehime' => '愛媛県',
        'kochi' => '高知県',
        'fukuoka' => '福岡県',
        'saga' => '佐賀県',
        'nagasaki' => '長崎県',
        'kumamoto' => '熊本県',
        'oita' => '大分県',
        'miyazaki' => '宮崎県',
        'kagoshima' => '鹿児島県',
        'okinawa' => '沖縄県'
    );
}

/**
 * サービス特徴のメタクエリマッピングを取得
 */
function get_service_meta_mapping($service) {
    $service_mapping = array(
        'cleaning' => array(
            'key' => 'cleaning_included',
            'value' => 'Yes',
            'compare' => '='
        ),
        '24h' => array(
            'key' => 'support_24h',
            'value' => 'Yes',
            'compare' => '='
        ),
        'airbnb' => array(
            'key' => 'airbnb_partner',
            'value' => 'Yes',
            'compare' => '='
        )
    );
    
    return isset($service_mapping[$service]) ? $service_mapping[$service] : false;
}

/**
 * 料金帯のメタクエリマッピングを取得
 */
function get_fee_meta_mapping($fee) {
    $fee_mapping = array(
        'low' => array(
            'key' => 'fee_structure',
            'value' => '(10%|[0-9]%)',
            'compare' => 'REGEXP'
        ),
        'middle' => array(
            'key' => 'fee_structure',
            'value' => '(1[1-5]%)',
            'compare' => 'REGEXP'
        ),
        'high' => array(
            'key' => 'fee_structure',
            'value' => '(1[6-9]%|2[0-9]%)',
            'compare' => 'REGEXP'
        )
    );
    
    return isset($fee_mapping[$fee]) ? $fee_mapping[$fee] : false;
}

/**
 * アーカイブページでの投稿数を設定
 */
function set_company_archive_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('company')) {
            $query->set('posts_per_page', 12);
        }
    }
}
add_action('pre_get_posts', 'set_company_archive_posts_per_page');

/**
 * 検索条件のラベルを取得
 */
function get_search_condition_labels() {
    return array(
        'area' => array(
            'hokkaido' => '❄️ 北海道',
            'aomori' => '🍎 青森',
            'iwate' => '🗻 岩手',
            'miyagi' => '🌾 宮城',
            'akita' => '🍙 秋田',
            'yamagata' => '🍒 山形',
            'fukushima' => '🌸 福島',
            'ibaraki' => '🌼 茨城',
            'tochigi' => '🍓 栃木',
            'gunma' => '🎍 群馬',
            'saitama' => '🏞️ 埼玉',
            'chiba' => '🌸 千葉',
            'tokyo' => '🗼 東京',
            'kanagawa' => '🌊 神奈川',
            'niigata' => '🍚 新潟',
            'toyama' => '🏔️ 富山',
            'ishikawa' => '⛩️ 石川',
            'fukui' => '🦀 福井',
            'yamanashi' => '🍇 山梨',
            'nagano' => '🏔️ 長野',
            'gifu' => '🏯 岐阜',
            'shizuoka' => '🗻 静岡',
            'aichi' => '🏭 愛知',
            'mie' => '🦪 三重',
            'shiga' => '🏞️ 滋賀',
            'kyoto' => '⛩️ 京都',
            'osaka' => '🏯 大阪',
            'hyogo' => '🏰 兵庫',
            'nara' => '🦌 奈良',
            'wakayama' => '🍊 和歌山',
            'tottori' => '🏜️ 鳥取',
            'shimane' => '⛩️ 島根',
            'okayama' => '🍑 岡山',
            'hiroshima' => '🕊️ 広島',
            'yamaguchi' => '🌉 山口',
            'tokushima' => '🌀 徳島',
            'kagawa' => '🍜 香川',
            'ehime' => '🍊 愛媛',
            'kochi' => '🐠 高知',
            'fukuoka' => '🍜 福岡',
            'saga' => '🍃 佐賀',
            'nagasaki' => '⛩️ 長崎',
            'kumamoto' => '🐻 熊本',
            'oita' => '♨️ 大分',
            'miyazaki' => '🌴 宮崎',
            'kagoshima' => '🌋 鹿児島',
            'okinawa' => '🏝️ 沖縄'
        ),
        'fee' => array(
            'low' => '💚 〜10%（お得）',
            'middle' => '💛 11%〜15%（標準）',
            'high' => '🧡 16%〜（プレミアム）'
        ),
        'service' => array(
            'cleaning' => '🧹 清掃込み',
            '24h' => '🌙 24時間対応',
            'airbnb' => '🏡 Airbnbパートナー'
        )
    );
}

/**
 * 検索フォーム用の都道府県選択肢を取得
 * 主要都市を上位に配置し、その他を地域別に整理
 */
function get_area_options_for_search() {
    return array(
        'major' => array(
            'tokyo' => '🗼 東京都',
            'osaka' => '🏯 大阪府',
            'kanagawa' => '🌊 神奈川県',
            'aichi' => '🏭 愛知県',
            'kyoto' => '⛩️ 京都府',
            'fukuoka' => '🍜 福岡県',
            'hyogo' => '🏰 兵庫県',
            'saitama' => '🏞️ 埼玉県',
            'chiba' => '🌸 千葉県',
            'hokkaido' => '❄️ 北海道'
        ),
        'tohoku' => array(
            'aomori' => '🍎 青森県',
            'iwate' => '🗻 岩手県',
            'miyagi' => '🌾 宮城県',
            'akita' => '🍙 秋田県',
            'yamagata' => '🍒 山形県',
            'fukushima' => '🌸 福島県'
        ),
        'kanto' => array(
            'ibaraki' => '🌼 茨城県',
            'tochigi' => '🍓 栃木県',
            'gunma' => '🎍 群馬県'
        ),
        'chubu' => array(
            'niigata' => '🍚 新潟県',
            'toyama' => '🏔️ 富山県',
            'ishikawa' => '⛩️ 石川県',
            'fukui' => '🦀 福井県',
            'yamanashi' => '🍇 山梨県',
            'nagano' => '🏔️ 長野県',
            'gifu' => '🏯 岐阜県',
            'shizuoka' => '🗻 静岡県',
            'mie' => '🦪 三重県'
        ),
        'kansai' => array(
            'shiga' => '🏞️ 滋賀県',
            'nara' => '🦌 奈良県',
            'wakayama' => '🍊 和歌山県'
        ),
        'chugoku' => array(
            'tottori' => '🏜️ 鳥取県',
            'shimane' => '⛩️ 島根県',
            'okayama' => '🍑 岡山県',
            'hiroshima' => '🕊️ 広島県',
            'yamaguchi' => '🌉 山口県'
        ),
        'shikoku' => array(
            'tokushima' => '🌀 徳島県',
            'kagawa' => '🍜 香川県',
            'ehime' => '🍊 愛媛県',
            'kochi' => '🐠 高知県'
        ),
        'kyushu' => array(
            'saga' => '🍃 佐賀県',
            'nagasaki' => '⛩️ 長崎県',
            'kumamoto' => '🐻 熊本県',
            'oita' => '♨️ 大分県',
            'miyazaki' => '🌴 宮崎県',
            'kagoshima' => '🌋 鹿児島県',
            'okinawa' => '🏝️ 沖縄県'
        )
    );
}

/**
 * 配列型カスタムフィールドのためのSQLクエリ修正
 */
function modify_company_search_where($where, $wp_query) {
    global $wpdb;
    
    if (!is_admin() && $wp_query->is_main_query() && is_post_type_archive('company')) {
        
        // エリア検索の場合の追加SQLクエリ
        if (!empty($_GET['area'])) {
            $area = sanitize_text_field($_GET['area']);
            $area_mapping = get_area_mapping();
            
            if (isset($area_mapping[$area])) {
                $prefecture = $area_mapping[$area];
                
                // 配列内検索用のSQL追加
                $where .= $wpdb->prepare(
                    " AND {$wpdb->posts}.ID IN (
                        SELECT post_id FROM {$wpdb->postmeta} 
                        WHERE meta_key = 'service_areas' 
                        AND (
                            meta_value LIKE %s 
                            OR meta_value LIKE %s 
                            OR meta_value LIKE %s
                        )
                    )",
                    '%"' . $prefecture . '"%',
                    '%' . serialize($prefecture) . '%',
                    '%' . $prefecture . '%'
                );
            }
        }
    }
    
    return $where;
}
add_filter('posts_where', 'modify_company_search_where', 10, 2); 