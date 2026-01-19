<?php
/**
 * カスタム投稿タイプの登録
 */

function minpaku_register_post_types() {
    // 運営会社
    register_post_type('company', array(
        'labels' => array(
            'name' => '運営会社',
            'singular_name' => '運営会社',
            'add_new' => '新規追加',
            'add_new_item' => '運営会社を追加',
            'edit_item' => '運営会社を編集',
            'new_item' => '新しい運営会社',
            'view_item' => '運営会社を表示',
            'search_items' => '運営会社を検索',
            'not_found' => '運営会社が見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱に運営会社はありません',
            'menu_name' => '運営会社'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon' => 'dashicons-building',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'companies'),
    ));

    // 宿泊施設
    register_post_type('hotel', array(
        'labels' => array(
            'name' => '宿泊施設',
            'singular_name' => '宿泊施設',
            'add_new' => '新規追加',
            'add_new_item' => '宿泊施設を追加',
            'edit_item' => '宿泊施設を編集',
            'new_item' => '新しい宿泊施設',
            'view_item' => '宿泊施設を表示',
            'search_items' => '宿泊施設を検索',
            'not_found' => '宿泊施設が見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱に宿泊施設はありません',
            'menu_name' => '宿泊施設'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-home',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'hotels'),
    ));
}
add_action('init', 'minpaku_register_post_types');

/**
 * 都道府県一覧を取得
 */
function get_prefecture_list() {
    return array(
        '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
        '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
        '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県',
        '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県',
        '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県',
        '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県',
        '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
    );
}

/**
 * カスタムフィールドの登録
 */
function minpaku_register_meta_boxes() {
    add_meta_box(
        'company_details',
        '運営会社の詳細情報',
        'minpaku_company_details_callback',
        'company',
        'normal',
        'high'
    );

    add_meta_box(
        'hotel_details',
        '宿泊施設の詳細情報',
        'minpaku_hotel_details_callback',
        'hotel',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'minpaku_register_meta_boxes');

/**
 * カスタムフィールドの表示
 */
function minpaku_company_details_callback($post) {
    wp_nonce_field('company_details_nonce', 'company_details_nonce');

    $service_type = get_post_meta($post->ID, 'service_type', true);
    $fee_structure = get_post_meta($post->ID, 'fee_structure', true);
    $property_count = get_post_meta($post->ID, 'property_count_raw', true);
    $support_24h = get_post_meta($post->ID, 'support_24h', true);
    $airbnb_partner = get_post_meta($post->ID, 'airbnb_partner', true);
    $cleaning_included = get_post_meta($post->ID, 'cleaning_included', true);
    $company_url = get_post_meta($post->ID, 'company_url', true);
    $company_address = get_post_meta($post->ID, 'company_address', true);
    $company_tel = get_post_meta($post->ID, 'company_tel', true);
    $service_areas = get_post_meta($post->ID, 'service_areas', true);
    if (!is_array($service_areas)) {
        $service_areas = array();
    }
    ?>

    <div class="company-meta-box">
        <style>
            .company-meta-box .field-group {
                margin-bottom: 20px;
                padding-bottom: 20px;
                border-bottom: 1px solid #eee;
            }
            .company-meta-box .field-group:last-child {
                border-bottom: none;
            }
            .company-meta-box .checkbox-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 10px;
                margin-top: 10px;
            }
            .company-meta-box .checkbox-label {
                display: flex;
                align-items: center;
                margin: 0;
            }
            .company-meta-box .checkbox-label input {
                margin-right: 5px;
            }
        </style>

        <div class="field-group">
            <h3>基本情報</h3>
            <p>
                <label for="company_url">会社URL：</label><br>
                <input type="url" id="company_url" name="company_url" value="<?php echo esc_attr($company_url); ?>" class="widefat">
            </p>
            
            <p>
                <label for="company_address">住所：</label><br>
                <input type="text" id="company_address" name="company_address" value="<?php echo esc_attr($company_address); ?>" class="widefat">
            </p>
            
            <p>
                <label for="company_tel">電話番号：</label><br>
                <input type="tel" id="company_tel" name="company_tel" value="<?php echo esc_attr($company_tel); ?>" class="widefat">
            </p>
        </div>

        <div class="field-group">
            <h3>サービス情報</h3>
            <p>
                <label for="service_type">サービスタイプ:</label><br>
                <input type="text" id="service_type" name="service_type" value="<?php echo esc_attr($service_type); ?>" class="widefat">
            </p>

            <p>
                <label for="fee_structure">料金体系:</label><br>
                <input type="text" id="fee_structure" name="fee_structure" value="<?php echo esc_attr($fee_structure); ?>" class="widefat">
            </p>

            <p>
                <label for="property_count">管理物件数:</label><br>
                <input type="number" id="property_count" name="property_count_raw" value="<?php echo esc_attr($property_count); ?>" class="widefat">
            </p>
        </div>

        <div class="field-group">
            <h3>対応地域</h3>
            
            <?php if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('manage_options')) : ?>
                <div style="background: #f0f0f1; padding: 10px; margin-bottom: 10px; border-left: 4px solid #0073aa;">
                    <strong>デバッグ情報:</strong><br>
                    取得データ: <code><?php echo esc_html(print_r($service_areas, true)); ?></code><br>
                    データ型: <code><?php echo gettype($service_areas); ?></code><br>
                    配列かどうか: <code><?php echo is_array($service_areas) ? 'Yes' : 'No'; ?></code><br>
                    配列の要素数: <code><?php echo is_array($service_areas) ? count($service_areas) : 'N/A'; ?></code>
                </div>
            <?php endif; ?>
            
            <div class="checkbox-grid">
                <?php foreach (get_prefecture_list() as $prefecture): ?>
                    <?php 
                    $is_checked = is_array($service_areas) && in_array($prefecture, $service_areas, true);
                    ?>
                    <label class="checkbox-label">
                        <input type="checkbox" 
                               name="service_areas[]" 
                               value="<?php echo esc_attr($prefecture); ?>"
                               <?php checked($is_checked); ?>>
                        <span><?php echo esc_html($prefecture); ?></span>
                        <?php if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('manage_options') && $is_checked) : ?>
                            <small style="color: green;">✓</small>
                        <?php endif; ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="field-group">
            <h3>その他の特徴</h3>
            <p>
                <label><input type="checkbox" name="support_24h" value="Yes" <?php checked($support_24h, 'Yes'); ?>> 24時間対応</label>
            </p>

            <p>
                <label><input type="checkbox" name="airbnb_partner" value="Yes" <?php checked($airbnb_partner, 'Yes'); ?>> Airbnbパートナー</label>
            </p>

            <p>
                <label><input type="checkbox" name="cleaning_included" value="Yes" <?php checked($cleaning_included, 'Yes'); ?>> 清掃込み</label>
            </p>
        </div>
    </div>
    <?php
}

/**
 * カスタムフィールドの保存
 */
function minpaku_save_company_details($post_id) {
    if (!isset($_POST['company_details_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['company_details_nonce'], 'company_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'service_type',
        'fee_structure',
        'property_count_raw',
        'support_24h',
        'airbnb_partner',
        'cleaning_included',
        'company_url',
        'company_address',
        'company_tel'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        } else {
            delete_post_meta($post_id, $field);
        }
    }

    // 対応地域の保存
    if (isset($_POST['service_areas'])) {
        $areas = array_map('sanitize_text_field', $_POST['service_areas']);
        update_post_meta($post_id, 'service_areas', $areas);
        
        // デバッグログ（開発時のみ）
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('Company ' . $post_id . ' service_areas saved: ' . print_r($areas, true));
        }
    } else {
        update_post_meta($post_id, 'service_areas', array());
        
        // デバッグログ（開発時のみ）
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('Company ' . $post_id . ' service_areas cleared (no POST data)');
        }
    }
}
add_action('save_post_company', 'minpaku_save_company_details');

/**
 * 対応地域データの診断機能（デバッグ用）
 */
function minpaku_diagnose_service_areas() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    $companies = get_posts(array(
        'post_type' => 'company',
        'posts_per_page' => -1,
        'post_status' => 'any'
    ));
    
    echo '<div class="notice notice-info"><p><strong>対応地域データ診断:</strong></p><ul>';
    
    foreach ($companies as $company) {
        $service_areas = get_post_meta($company->ID, 'service_areas', true);
        echo '<li>';
        echo '<strong>' . esc_html($company->post_title) . ' (ID: ' . $company->ID . '):</strong> ';
        echo 'タイプ: ' . gettype($service_areas) . ', ';
        echo '値: ' . esc_html(print_r($service_areas, true));
        echo '</li>';
    }
    
    echo '</ul></div>';
}

// デバッグ用アクション（管理画面でのみ実行）
if (defined('WP_DEBUG') && WP_DEBUG && is_admin() && isset($_GET['debug_service_areas'])) {
    add_action('admin_notices', 'minpaku_diagnose_service_areas');
}

/**
 * 対応地域データの修復機能
 */
function minpaku_fix_service_areas_data() {
    if (!current_user_can('manage_options')) {
        wp_die('権限がありません');
    }
    
    $companies = get_posts(array(
        'post_type' => 'company',
        'posts_per_page' => -1,
        'post_status' => 'any'
    ));
    
    $fixed_count = 0;
    
    foreach ($companies as $company) {
        $service_areas = get_post_meta($company->ID, 'service_areas', true);
        
        // 文字列の場合は配列に変換
        if (is_string($service_areas) && !empty($service_areas)) {
            // パイプ区切りの場合
            if (strpos($service_areas, '|') !== false) {
                $areas = explode('|', $service_areas);
                $areas = array_map('trim', $areas);
                $areas = array_filter($areas);
                update_post_meta($company->ID, 'service_areas', $areas);
                $fixed_count++;
            }
            // カンマ区切りの場合
            elseif (strpos($service_areas, ',') !== false) {
                $areas = explode(',', $service_areas);
                $areas = array_map('trim', $areas);
                $areas = array_filter($areas);
                update_post_meta($company->ID, 'service_areas', $areas);
                $fixed_count++;
            }
            // 単一の値の場合
            else {
                update_post_meta($company->ID, 'service_areas', array(trim($service_areas)));
                $fixed_count++;
            }
        }
        // 空の場合は空配列に設定
        elseif (empty($service_areas) || $service_areas === false) {
            update_post_meta($company->ID, 'service_areas', array());
        }
    }
    
    wp_redirect(add_query_arg('fixed_areas', $fixed_count, wp_get_referer()));
    exit;
}

// データ修復用アクション
if (is_admin() && isset($_GET['action']) && $_GET['action'] === 'fix_service_areas') {
    add_action('init', 'minpaku_fix_service_areas_data');
}

/**
 * 宿泊施設のカスタムフィールド表示
 */
function minpaku_hotel_details_callback($post) {
    wp_nonce_field('hotel_details_nonce', 'hotel_details_nonce');

    $hotel_type = get_post_meta($post->ID, 'hotel_type', true);
    $hotel_address = get_post_meta($post->ID, 'hotel_address', true);
    $hotel_prefecture = get_post_meta($post->ID, 'hotel_prefecture', true);
    $hotel_tel = get_post_meta($post->ID, 'hotel_tel', true);
    $hotel_url = get_post_meta($post->ID, 'hotel_url', true);
    $check_in_time = get_post_meta($post->ID, 'check_in_time', true);
    $check_out_time = get_post_meta($post->ID, 'check_out_time', true);
    $room_count = get_post_meta($post->ID, 'room_count', true);
    $price_range_min = get_post_meta($post->ID, 'price_range_min', true);
    $price_range_max = get_post_meta($post->ID, 'price_range_max', true);
    $amenities = get_post_meta($post->ID, 'amenities', true);
    if (!is_array($amenities)) {
        $amenities = array();
    }
    $gallery_images = get_post_meta($post->ID, 'hotel_gallery', true);
    if (!is_array($gallery_images)) {
        $gallery_images = array();
    }
    ?>

    <div class="hotel-meta-box">
        <style>
            .hotel-meta-box .field-group {
                margin-bottom: 20px;
                padding-bottom: 20px;
                border-bottom: 1px solid #eee;
            }
            .hotel-meta-box .field-group:last-child {
                border-bottom: none;
            }
            .hotel-meta-box .checkbox-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 10px;
                margin-top: 10px;
            }
            .hotel-meta-box .checkbox-label {
                display: flex;
                align-items: center;
                margin: 0;
            }
            .hotel-meta-box .checkbox-label input {
                margin-right: 5px;
            }
            .hotel-meta-box .inline-fields {
                display: flex;
                gap: 15px;
                align-items: center;
            }
            .hotel-meta-box .inline-fields > div {
                flex: 1;
            }
            .gallery-images-container {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 15px;
                margin-top: 15px;
            }
            .gallery-image-item {
                position: relative;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 5px;
                background: #f9f9f9;
            }
            .gallery-image-item img {
                width: 100%;
                height: 120px;
                object-fit: cover;
                border-radius: 2px;
            }
            .gallery-image-item .remove-image {
                position: absolute;
                top: 10px;
                right: 10px;
                background: #dc3545;
                color: white;
                border: none;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                cursor: pointer;
                font-size: 16px;
                line-height: 1;
                padding: 0;
            }
            .gallery-image-item .remove-image:hover {
                background: #c82333;
            }
            #add-gallery-image {
                display: inline-block;
                padding: 10px 20px;
                background: #0073aa;
                color: white;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                font-size: 14px;
            }
            #add-gallery-image:hover {
                background: #005177;
            }
        </style>

        <div class="field-group">
            <h3>基本情報</h3>
            
            <p>
                <label for="hotel_type">施設タイプ：</label><br>
                <select id="hotel_type" name="hotel_type" class="widefat">
                    <option value="">選択してください</option>
                    <option value="ホテル" <?php selected($hotel_type, 'ホテル'); ?>>ホテル</option>
                    <option value="旅館" <?php selected($hotel_type, '旅館'); ?>>旅館</option>
                    <option value="民宿" <?php selected($hotel_type, '民宿'); ?>>民宿</option>
                    <option value="ゲストハウス" <?php selected($hotel_type, 'ゲストハウス'); ?>>ゲストハウス</option>
                    <option value="ペンション" <?php selected($hotel_type, 'ペンション'); ?>>ペンション</option>
                    <option value="コンドミニアム" <?php selected($hotel_type, 'コンドミニアム'); ?>>コンドミニアム</option>
                    <option value="その他" <?php selected($hotel_type, 'その他'); ?>>その他</option>
                </select>
            </p>

            <p>
                <label for="hotel_prefecture">都道府県：</label><br>
                <select id="hotel_prefecture" name="hotel_prefecture" class="widefat">
                    <option value="">選択してください</option>
                    <?php foreach (get_prefecture_list() as $prefecture): ?>
                        <option value="<?php echo esc_attr($prefecture); ?>" <?php selected($hotel_prefecture, $prefecture); ?>>
                            <?php echo esc_html($prefecture); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            
            <p>
                <label for="hotel_address">住所：</label><br>
                <input type="text" id="hotel_address" name="hotel_address" value="<?php echo esc_attr($hotel_address); ?>" class="widefat">
            </p>
            
            <p>
                <label for="hotel_tel">電話番号：</label><br>
                <input type="tel" id="hotel_tel" name="hotel_tel" value="<?php echo esc_attr($hotel_tel); ?>" class="widefat">
            </p>

            <p>
                <label for="hotel_url">ウェブサイトURL：</label><br>
                <input type="url" id="hotel_url" name="hotel_url" value="<?php echo esc_attr($hotel_url); ?>" class="widefat">
            </p>
        </div>

        <div class="field-group">
            <h3>施設情報</h3>
            
            <p>
                <label for="room_count">部屋数：</label><br>
                <input type="number" id="room_count" name="room_count" value="<?php echo esc_attr($room_count); ?>" class="widefat" min="1">
            </p>

            <div class="inline-fields">
                <div>
                    <label for="check_in_time">チェックイン時刻：</label><br>
                    <input type="time" id="check_in_time" name="check_in_time" value="<?php echo esc_attr($check_in_time); ?>" class="widefat">
                </div>
                <div>
                    <label for="check_out_time">チェックアウト時刻：</label><br>
                    <input type="time" id="check_out_time" name="check_out_time" value="<?php echo esc_attr($check_out_time); ?>" class="widefat">
                </div>
            </div>
        </div>

        <div class="field-group">
            <h3>料金情報</h3>
            <p>1泊あたりの料金範囲（円）</p>
            <div class="inline-fields">
                <div>
                    <label for="price_range_min">最低料金：</label><br>
                    <input type="number" id="price_range_min" name="price_range_min" value="<?php echo esc_attr($price_range_min); ?>" class="widefat" min="0" step="1000">
                </div>
                <div>
                    <label for="price_range_max">最高料金：</label><br>
                    <input type="number" id="price_range_max" name="price_range_max" value="<?php echo esc_attr($price_range_max); ?>" class="widefat" min="0" step="1000">
                </div>
            </div>
        </div>

        <div class="field-group">
            <h3>設備・アメニティ</h3>
            <div class="checkbox-grid">
                <?php
                $amenity_list = array(
                    'WiFi無料',
                    '駐車場',
                    '温泉',
                    '大浴場',
                    'レストラン',
                    'バー',
                    'コンビニ（徒歩5分）',
                    '喫煙室',
                    'ペット可',
                    'バリアフリー',
                    '洗濯機',
                    'キッチン',
                    'エアコン',
                    'テレビ',
                    '冷蔵庫',
                    'ドライヤー',
                    'アメニティ',
                    'タオル',
                    'シャンプー・リンス',
                    '歯ブラシ'
                );
                foreach ($amenity_list as $amenity):
                    $is_checked = is_array($amenities) && in_array($amenity, $amenities, true);
                ?>
                    <label class="checkbox-label">
                        <input type="checkbox" 
                               name="amenities[]" 
                               value="<?php echo esc_attr($amenity); ?>"
                               <?php checked($is_checked); ?>>
                        <span><?php echo esc_html($amenity); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="field-group">
            <h3>施設画像ギャラリー</h3>
            <p>施設の写真を複数登録できます（部屋、外観、設備など）</p>
            
            <div id="gallery-images-wrapper">
                <input type="hidden" id="hotel_gallery" name="hotel_gallery" value="<?php echo esc_attr(implode(',', $gallery_images)); ?>">
                <div class="gallery-images-container" id="gallery-images-container">
                    <?php foreach ($gallery_images as $image_id): ?>
                        <?php if ($image_id && wp_get_attachment_url($image_id)): ?>
                            <div class="gallery-image-item" data-image-id="<?php echo esc_attr($image_id); ?>">
                                <img src="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>" alt="">
                                <button type="button" class="remove-image" onclick="removeGalleryImage(this)">×</button>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <p style="margin-top: 15px;">
                <button type="button" id="add-gallery-image" class="button">📷 画像を追加</button>
            </p>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        var galleryFrame;
        
        // 画像追加ボタン
        $('#add-gallery-image').on('click', function(e) {
            e.preventDefault();
            
            if (galleryFrame) {
                galleryFrame.open();
                return;
            }
            
            galleryFrame = wp.media({
                title: '施設画像を選択',
                button: {
                    text: '画像を追加'
                },
                multiple: true
            });
            
            galleryFrame.on('select', function() {
                var attachments = galleryFrame.state().get('selection').toJSON();
                
                attachments.forEach(function(attachment) {
                    var imageId = attachment.id;
                    var imageUrl = attachment.url;
                    
                    // 既に追加されていないかチェック
                    if ($('.gallery-image-item[data-image-id="' + imageId + '"]').length === 0) {
                        var imageHtml = '<div class="gallery-image-item" data-image-id="' + imageId + '">' +
                                      '<img src="' + imageUrl + '" alt="">' +
                                      '<button type="button" class="remove-image" onclick="removeGalleryImage(this)">×</button>' +
                                      '</div>';
                        $('#gallery-images-container').append(imageHtml);
                    }
                });
                
                updateGalleryInput();
            });
            
            galleryFrame.open();
        });
    });
    
    // 画像削除
    function removeGalleryImage(button) {
        jQuery(button).closest('.gallery-image-item').remove();
        updateGalleryInput();
    }
    
    // hidden inputの更新
    function updateGalleryInput() {
        var imageIds = [];
        jQuery('.gallery-image-item').each(function() {
            imageIds.push(jQuery(this).data('image-id'));
        });
        jQuery('#hotel_gallery').val(imageIds.join(','));
    }
    </script>
    <?php
}

/**
 * 宿泊施設のカスタムフィールド保存
 */
function minpaku_save_hotel_details($post_id) {
    if (!isset($_POST['hotel_details_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['hotel_details_nonce'], 'hotel_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'hotel_type',
        'hotel_address',
        'hotel_prefecture',
        'hotel_tel',
        'hotel_url',
        'check_in_time',
        'check_out_time',
        'room_count',
        'price_range_min',
        'price_range_max'
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        } else {
            delete_post_meta($post_id, $field);
        }
    }

    // アメニティの保存
    if (isset($_POST['amenities'])) {
        $amenities_array = array_map('sanitize_text_field', $_POST['amenities']);
        update_post_meta($post_id, 'amenities', $amenities_array);
    } else {
        update_post_meta($post_id, 'amenities', array());
    }

    // ギャラリー画像の保存
    if (isset($_POST['hotel_gallery'])) {
        $gallery_string = sanitize_text_field($_POST['hotel_gallery']);
        if (!empty($gallery_string)) {
            $gallery_ids = array_map('intval', explode(',', $gallery_string));
            $gallery_ids = array_filter($gallery_ids); // 空の値を除外
            update_post_meta($post_id, 'hotel_gallery', $gallery_ids);
        } else {
            update_post_meta($post_id, 'hotel_gallery', array());
        }
    } else {
        update_post_meta($post_id, 'hotel_gallery', array());
    }
}
add_action('save_post_hotel', 'minpaku_save_hotel_details'); 