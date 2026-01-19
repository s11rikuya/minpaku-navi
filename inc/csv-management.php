<?php
/**
 * CSV管理機能
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * CSVエクスポート機能を管理メニューに追加
 */
function add_company_csv_export_menu() {
    add_submenu_page(
        'edit.php?post_type=company',
        '運営会社CSV管理',
        'CSV管理',
        'manage_options',
        'company-csv',
        'render_company_csv_management_page'
    );
}
add_action('admin_menu', 'add_company_csv_export_menu');

/**
 * CSV管理ページの表示
 */
function render_company_csv_management_page() {
    ?>
    <div class="wrap">
        <h1>運営会社CSV管理</h1>
        
        <?php if (isset($_GET['updated']) && $_GET['updated'] === 'true') : ?>
            <div class="notice notice-success is-dismissible">
                <p>CSVインポートが完了しました。</p>
            </div>
        <?php endif; ?>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2 class="title">CSVエクスポート</h2>
            <p>現在登録されている運営会社情報をCSVファイルとしてダウンロードします。</p>
            <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                <?php wp_nonce_field('company_csv_export', 'company_csv_export_nonce'); ?>
                <input type="hidden" name="action" value="export_companies_csv">
                <p class="submit">
                    <input type="submit" class="button button-primary" value="CSVをダウンロード">
                </p>
            </form>
        </div>

        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2 class="title">CSVインポート</h2>
            <p>CSVファイルから運営会社情報を一括更新します。</p>
            <div class="notice notice-info inline">
                <p><strong>注意:</strong> CSVファイルの形式は、エクスポートしたファイルと同じ形式である必要があります。</p>
            </div>
            <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" enctype="multipart/form-data">
                <?php wp_nonce_field('company_csv_import', 'company_csv_import_nonce'); ?>
                <input type="hidden" name="action" value="import_companies_csv">
                <table class="form-table">
                    <tr>
                        <th scope="row">CSVファイル</th>
                        <td>
                            <input type="file" name="companies_csv" accept=".csv" required>
                            <p class="description">アップロードするCSVファイルを選択してください。</p>
                        </td>
                    </tr>
                </table>
                <p class="submit">
                    <input type="submit" class="button button-primary" value="CSVをインポート" 
                           onclick="return confirm('既存のデータが更新されます。実行してよろしいですか？');">
                </p>
            </form>
        </div>

        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2 class="title">CSVフォーマット</h2>
            <p>CSVファイルには以下の列が含まれている必要があります：</p>
            <table class="widefat fixed striped">
                <thead>
                    <tr>
                        <th>列名</th>
                        <th>説明</th>
                        <th>必須</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>ID</td><td>投稿ID（更新時に使用）</td><td>○</td></tr>
                    <tr><td>タイトル</td><td>会社名</td><td>○</td></tr>
                    <tr><td>会社URL</td><td>会社のWebサイトURL</td><td></td></tr>
                    <tr><td>住所</td><td>会社の住所</td><td></td></tr>
                    <tr><td>電話番号</td><td>会社の電話番号</td><td></td></tr>
                    <tr><td>サービスタイプ</td><td>提供サービスの種類</td><td></td></tr>
                    <tr><td>料金体系</td><td>料金体系の説明</td><td></td></tr>
                    <tr><td>管理物件数</td><td>管理している物件数</td><td></td></tr>
                    <tr><td>24時間対応</td><td>Yes/No</td><td></td></tr>
                    <tr><td>Airbnbパートナー</td><td>Yes/No</td><td></td></tr>
                    <tr><td>清掃込み</td><td>Yes/No</td><td></td></tr>
                    <tr><td>対応地域</td><td>パイプ(|)区切りで複数指定</td><td></td></tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}

/**
 * CSVエクスポート処理
 */
function handle_company_csv_export() {
    // 権限チェック
    if (!current_user_can('manage_options')) {
        wp_die('権限がありません');
    }

    // ナンス検証
    if (!isset($_POST['company_csv_export_nonce']) || 
        !wp_verify_nonce($_POST['company_csv_export_nonce'], 'company_csv_export')) {
        wp_die('不正なリクエストです');
    }

    // 会社情報を取得
    $companies = get_posts(array(
        'post_type' => 'company',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ));

    // CSVヘッダー
    $csv_headers = get_csv_headers();

    // 出力バッファを開始
    ob_start();
    $output = fopen("php://output", 'w');
    
    // UTF-8 BOM
    fputs($output, "\xEF\xBB\xBF");
    
    // ヘッダーを書き込み
    fputcsv($output, $csv_headers);

    // データを書き込み
    foreach ($companies as $company) {
        $row = prepare_company_csv_row($company);
        fputcsv($output, $row);
    }

    fclose($output);
    $csv = ob_get_clean();

    // ヘッダーを設定してダウンロード
    $filename = 'companies_' . date('Y-m-d_H-i-s') . '.csv';
    
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    echo $csv;
    exit;
}
add_action('admin_post_export_companies_csv', 'handle_company_csv_export');

/**
 * CSVインポート処理
 */
function handle_company_csv_import() {
    // 権限チェック
    if (!current_user_can('manage_options')) {
        wp_die('権限がありません');
    }

    // ナンス検証
    if (!isset($_POST['company_csv_import_nonce']) || 
        !wp_verify_nonce($_POST['company_csv_import_nonce'], 'company_csv_import')) {
        wp_die('不正なリクエストです');
    }

    // ファイルアップロードチェック
    if (!isset($_FILES['companies_csv']) || $_FILES['companies_csv']['error'] !== UPLOAD_ERR_OK) {
        wp_die('ファイルのアップロードに失敗しました');
    }

    // CSVファイルを処理
    $result = process_csv_import($_FILES['companies_csv']['tmp_name']);
    
    if ($result['success']) {
        // 成功時のリダイレクト
        $redirect_url = add_query_arg(
            array('updated' => 'true', 'imported' => $result['imported']),
            wp_get_referer()
        );
    } else {
        // エラー時のリダイレクト
        $redirect_url = add_query_arg(
            array('error' => urlencode($result['message'])),
            wp_get_referer()
        );
    }

    wp_redirect($redirect_url);
    exit;
}
add_action('admin_post_import_companies_csv', 'handle_company_csv_import');

/**
 * CSVヘッダーを取得
 */
function get_csv_headers() {
    return array(
        'ID',
        'タイトル',
        '会社URL',
        '住所',
        '電話番号',
        'サービスタイプ',
        '料金体系',
        '管理物件数',
        '24時間対応',
        'Airbnbパートナー',
        '清掃込み',
        '対応地域'
    );
}

/**
 * 会社データからCSV行を準備
 */
function prepare_company_csv_row($company) {
    $service_areas = get_post_meta($company->ID, 'service_areas', true);
    $service_areas_str = is_array($service_areas) ? implode('|', $service_areas) : '';

    return array(
        $company->ID,
        $company->post_title,
        get_post_meta($company->ID, 'company_url', true),
        get_post_meta($company->ID, 'company_address', true),
        get_post_meta($company->ID, 'company_tel', true),
        get_post_meta($company->ID, 'service_type', true),
        get_post_meta($company->ID, 'fee_structure', true),
        get_post_meta($company->ID, 'property_count_raw', true),
        get_post_meta($company->ID, 'support_24h', true),
        get_post_meta($company->ID, 'airbnb_partner', true),
        get_post_meta($company->ID, 'cleaning_included', true),
        $service_areas_str
    );
}

/**
 * CSVインポートを処理
 */
function process_csv_import($file_path) {
    $file = fopen($file_path, 'r');
    if ($file === false) {
        return array('success' => false, 'message' => 'ファイルの読み込みに失敗しました');
    }

    // UTF-8 BOMをスキップ
    $bom = fread($file, 3);
    if ($bom !== "\xEF\xBB\xBF") {
        rewind($file);
    }
    
    // ヘッダー行をスキップ
    fgetcsv($file);

    $imported_count = 0;
    $errors = array();

    // データを処理
    while (($row = fgetcsv($file)) !== false) {
        $result = import_company_row($row);
        if ($result['success']) {
            $imported_count++;
        } else {
            $errors[] = $result['message'];
        }
    }

    fclose($file);

    if (!empty($errors)) {
        return array(
            'success' => false, 
            'message' => 'エラーが発生しました: ' . implode(', ', $errors)
        );
    }

    return array('success' => true, 'imported' => $imported_count);
}

/**
 * 単一の会社行をインポート
 */
function import_company_row($row) {
    $company_id = intval($row[0]);
    
    if ($company_id <= 0) {
        return array('success' => false, 'message' => '無効なIDです');
    }

    // 投稿を更新
    $post_result = wp_update_post(array(
        'ID' => $company_id,
        'post_title' => sanitize_text_field($row[1])
    ));

    if (is_wp_error($post_result)) {
        return array('success' => false, 'message' => '投稿の更新に失敗しました');
    }

    // メタデータを更新
    $meta_fields = array(
        'company_url' => $row[2],
        'company_address' => $row[3],
        'company_tel' => $row[4],
        'service_type' => $row[5],
        'fee_structure' => $row[6],
        'property_count_raw' => $row[7],
        'support_24h' => $row[8],
        'airbnb_partner' => $row[9],
        'cleaning_included' => $row[10]
    );

    foreach ($meta_fields as $key => $value) {
        update_post_meta($company_id, $key, sanitize_text_field($value));
    }
    
    // 対応地域を更新
    if (!empty($row[11])) {
        $service_areas = explode('|', $row[11]);
        $service_areas = array_map('sanitize_text_field', $service_areas);
        $service_areas = array_filter($service_areas); // 空の要素を除去
        update_post_meta($company_id, 'service_areas', $service_areas);
    }

    return array('success' => true);
} 