<?php
/**
 * Template Name: 一括見積もりフォーム
 */

get_header();
?>

    <div class="max-w-3xl mx-auto px-2 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow-sm rounded-xl p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">民泊運営代行 一括見積もり</h1>

        <form id="estimate-form" class="space-y-8">
            <!-- 基本情報 -->
            <div>
                <h2 class="text-lg font-medium text-gray-900 mb-4">基本情報</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">お名前 <span class="text-red-600">*</span></label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス <span class="text-red-600">*</span></label>
                        <input type="email" name="email" id="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">電話番号 <span class="text-red-600">*</span></label>
                        <input type="tel" name="phone" id="phone" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>
            </div>

            <!-- 物件情報 -->
            <div>
                <h2 class="text-lg font-medium text-gray-900 mb-4">物件情報</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="property_address" class="block text-sm font-medium text-gray-700">物件所在地 <span class="text-red-600">*</span></label>
                        <input type="text" name="property_address" id="property_address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>

                    <div>
                        <label for="property_type" class="block text-sm font-medium text-gray-700">物件種別 <span class="text-red-600">*</span></label>
                        <select name="property_type" id="property_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">選択してください</option>
                            <option value="apartment">マンション</option>
                            <option value="house">一戸建て</option>
                            <option value="villa">別荘</option>
                            <option value="other">その他</option>
                        </select>
                    </div>

                    <div>
                        <label for="room_size" class="block text-sm font-medium text-gray-700">部屋の広さ（㎡） <span class="text-red-600">*</span></label>
                        <input type="number" name="room_size" id="room_size" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>

                    <div>
                        <label for="max_guests" class="block text-sm font-medium text-gray-700">最大宿泊人数 <span class="text-red-600">*</span></label>
                        <input type="number" name="max_guests" id="max_guests" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>
            </div>

            <!-- 希望するサービス -->
            <div>
                <h2 class="text-lg font-medium text-gray-900 mb-4">希望するサービス</h2>
                <div class="space-y-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="services[]" value="cleaning" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-600">清掃サービス</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="services[]" value="key_management" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-600">鍵の受け渡し代行</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="services[]" value="listing_management" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-600">物件掲載管理</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="services[]" value="guest_support" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-600">ゲストサポート</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- 備考欄 -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700">備考欄</label>
                <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"></textarea>
                <p class="mt-2 text-sm text-gray-500">その他ご要望がございましたらご記入ください。</p>
            </div>

            <!-- プライバシーポリシー -->
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="privacy_policy" required class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                    <span class="ml-2 text-sm text-gray-600">
                        <a href="/privacy-policy" class="text-primary-600 hover:text-primary-500">プライバシーポリシー</a>に同意する
                    </span>
                </label>
            </div>

            <!-- 送信ボタン -->
            <div>
                <button type="submit" class="btn-primary w-full justify-center">
                    一括見積もりを依頼する
                </button>
            </div>
        </form>
    </div>

    <!-- 説明セクション -->
    <div class="mt-12 bg-gray-50 rounded-xl p-8">
        <h2 class="text-xl font-bold text-gray-900 mb-6">一括見積もりの流れ</h2>
        <div class="space-y-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                        1
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">フォームの入力</h3>
                    <p class="mt-2 text-gray-600">必要事項を入力して送信してください。</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                        2
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">運営会社への共有</h3>
                    <p class="mt-2 text-gray-600">ご入力いただいた情報を、厳選された運営会社に共有します。</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                        3
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">見積もり受け取り</h3>
                    <p class="mt-2 text-gray-600">各運営会社から個別に見積もりが届きます。</p>
                </div>
            </div>

            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                        4
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">比較検討</h3>
                    <p class="mt-2 text-gray-600">複数の見積もりを比較して、最適な運営会社を選択できます。</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('estimate-form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // フォームデータの収集
        const formData = new FormData(form);
        
        // ここにAjax送信処理を実装
        // 例: fetch('/wp-json/minpaku/v1/estimate', {
        //     method: 'POST',
        //     body: formData
        // })
        
        // 送信完了メッセージの表示
        alert('見積もり依頼を受け付けました。担当者からご連絡いたします。');
        form.reset();
    });
});
</script>

<?php get_footer(); ?> 