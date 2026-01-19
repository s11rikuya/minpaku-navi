<?php
/**
 * REST APIエンドポイントの登録
 */

function minpaku_register_rest_routes() {
    register_rest_route('minpaku/v1', '/estimate', array(
        'methods' => 'POST',
        'callback' => 'minpaku_handle_estimate_request',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'minpaku_register_rest_routes');

/**
 * 見積もりリクエストの処理
 */
function minpaku_handle_estimate_request($request) {
    $params = $request->get_params();
    
    // 必須項目のバリデーション
    $required_fields = array('name', 'email', 'phone', 'property_address', 'property_type', 'room_size', 'max_guests');
    foreach ($required_fields as $field) {
        if (empty($params[$field])) {
            return new WP_Error('missing_field', $field . 'は必須項目です。', array('status' => 400));
        }
    }

    // メールアドレスのバリデーション
    if (!is_email($params['email'])) {
        return new WP_Error('invalid_email', '有効なメールアドレスを入力してください。', array('status' => 400));
    }

    // 見積もり情報の保存
    $estimate_data = array(
        'post_title' => $params['name'] . 'からの見積もり依頼',
        'post_type' => 'estimate',
        'post_status' => 'private',
        'meta_input' => array(
            'client_name' => sanitize_text_field($params['name']),
            'client_email' => sanitize_email($params['email']),
            'client_phone' => sanitize_text_field($params['phone']),
            'property_address' => sanitize_text_field($params['property_address']),
            'property_type' => sanitize_text_field($params['property_type']),
            'room_size' => intval($params['room_size']),
            'max_guests' => intval($params['max_guests']),
            'services' => isset($params['services']) ? array_map('sanitize_text_field', $params['services']) : array(),
            'notes' => isset($params['notes']) ? sanitize_textarea_field($params['notes']) : '',
        ),
    );

    $post_id = wp_insert_post($estimate_data);

    if (is_wp_error($post_id)) {
        return new WP_Error('db_error', '見積もり依頼の保存に失敗しました。', array('status' => 500));
    }

    // 管理者への通知メール
    $admin_email = get_option('admin_email');
    $subject = '新しい見積もり依頼が届きました';
    $message = "新しい見積もり依頼が届きました。\n\n";
    $message .= "お名前: " . $params['name'] . "\n";
    $message .= "メールアドレス: " . $params['email'] . "\n";
    $message .= "電話番号: " . $params['phone'] . "\n";
    $message .= "物件所在地: " . $params['property_address'] . "\n";
    $message .= "物件種別: " . $params['property_type'] . "\n";
    $message .= "部屋の広さ: " . $params['room_size'] . "㎡\n";
    $message .= "最大宿泊人数: " . $params['max_guests'] . "人\n";
    
    if (!empty($params['services'])) {
        $message .= "\n希望するサービス:\n";
        foreach ($params['services'] as $service) {
            $message .= "- " . $service . "\n";
        }
    }

    if (!empty($params['notes'])) {
        $message .= "\n備考:\n" . $params['notes'] . "\n";
    }

    $message .= "\n管理画面で詳細を確認: " . admin_url('post.php?post=' . $post_id . '&action=edit');

    wp_mail($admin_email, $subject, $message);

    // クライアントへの自動返信メール
    $client_subject = '見積もり依頼を受け付けました';
    $client_message = $params['name'] . " 様\n\n";
    $client_message .= "この度は見積もり依頼をいただき、ありがとうございます。\n";
    $client_message .= "内容を確認の上、担当者より順次ご連絡させていただきます。\n\n";
    $client_message .= "【ご依頼内容】\n";
    $client_message .= "物件所在地: " . $params['property_address'] . "\n";
    $client_message .= "物件種別: " . $params['property_type'] . "\n";
    $client_message .= "部屋の広さ: " . $params['room_size'] . "㎡\n";
    $client_message .= "最大宿泊人数: " . $params['max_guests'] . "人\n";

    if (!empty($params['services'])) {
        $client_message .= "\n希望するサービス:\n";
        foreach ($params['services'] as $service) {
            $client_message .= "- " . $service . "\n";
        }
    }

    $client_message .= "\nご不明な点がございましたら、お気軽にお問い合わせください。\n";
    $client_message .= "今後ともよろしくお願いいたします。\n\n";
    $client_message .= get_bloginfo('name');

    wp_mail($params['email'], $client_subject, $client_message);

    return array(
        'success' => true,
        'message' => '見積もり依頼を受け付けました。',
    );
}

/**
 * 見積もりカスタム投稿タイプの登録
 */
function minpaku_register_estimate_post_type() {
    register_post_type('estimate', array(
        'labels' => array(
            'name' => '見積もり依頼',
            'singular_name' => '見積もり依頼',
            'menu_name' => '見積もり依頼',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-calculator',
        'supports' => array('title'),
    ));
}
add_action('init', 'minpaku_register_estimate_post_type'); 