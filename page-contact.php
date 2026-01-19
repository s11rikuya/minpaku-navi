<?php
/**
 * Template Name: お問い合わせページ
 */

get_header(); ?>

<main class="main-content bg-gray-50 py-8 md:py-12">
    <div class="container mx-auto px-2">
        <div class="max-w-3xl mx-auto">
            <!-- ページヘッダー -->
            <header class="text-center mb-8 md:mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    <?php the_title(); ?>
                </h1>
                <p class="text-gray-600 text-lg">
                    お問い合わせ内容をご入力ください。<br>
                    通常2-3営業日以内にご返信いたします。
                </p>
            </header>

            <!-- LINE誘導ブロック -->
            <section aria-labelledby="line-contact" class="mb-8">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6">
                    <div class="flex flex-col md:flex-row md:items-center gap-6">
                        <div class="flex-1">
                            <h2 id="line-contact" class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <!-- LINE風アイコン -->
                                <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" class="text-[#06C755]">
                                    <path d="M20 11c0 4.418-4.03 8-9 8-1.05 0-2.05-.15-2.98-.43L4 20l1.48-2.75C4.58 16.19 4 14.66 4 13c0-4.418 4.03-8 9-8s7 3.582 7 6z" fill="currentColor"/>
                                </svg>
                                LINEでのお問い合わせ（かんたん・最短）
                            </h2>
                            <p class="mt-2 text-gray-700 text-sm md:text-base">
                                すぐに相談したい方は、LINE公式アカウントからメッセージをお送りください。<br class="hidden md:block">
                                担当者が内容を確認し、順次ご返信いたします。
                            </p>
                        </div>
                        <div class="shrink-0 text-center">
                            <a id="line-cta-contact"
                               href="https://lin.ee/CcPftbU"
                               target="_blank" rel="noopener"
                               class="inline-block"
                               aria-label="LINE公式アカウントへ（友だち追加／お問い合わせ）"
                               data-analytics="line_cta_contact" data-position="contact_header">
                                <img
                                    src="https://hudousanlink.jp/wp-content/uploads/2025/09/LINE_Brand_icon.png"
                                    alt="LINEでお問い合わせ / 友だち追加"
                                    loading="lazy"
                                    class="h-20 md:h-24 lg:h-28 w-auto"
                                />
                            </a>
                            <p class="mt-2 text-xs text-gray-500">友だち追加後、メッセージでご相談ください。</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- お問い合わせの種類選択 -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">お問い合わせの種類を選択</h2>
                <div class="space-y-4">
                    <!-- 上段：2つの項目 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- 情報修正依頼 -->
                        <div class="border border-blue-100 rounded-lg p-4 bg-blue-50 cursor-pointer hover:bg-blue-100 transition-colors" 
                             onclick="document.getElementById('inquiry-type').value='情報修正依頼';">
                            <div class="text-center">
                                <span class="text-2xl mb-2 block">✏️</span>
                                <h3 class="font-bold text-gray-900 mb-2">情報修正依頼</h3>
                                <p class="text-sm text-gray-600">
                                    掲載情報の修正や<br>
                                    最新情報への更新依頼
                                </p>
                            </div>
                        </div>

                        <!-- 掲載依頼 -->
                        <div class="border border-green-100 rounded-lg p-4 bg-green-50 cursor-pointer hover:bg-green-100 transition-colors"
                             onclick="document.getElementById('inquiry-type').value='掲載依頼';">
                            <div class="text-center">
                                <span class="text-2xl mb-2 block">📢</span>
                                <h3 class="font-bold text-gray-900 mb-2">掲載依頼</h3>
                                <p class="text-sm text-gray-600">
                                    新規の運営会社<br>
                                    掲載のご相談
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 下段：代行相談 -->
                    <div class="flex justify-center">
                        <div class="w-full md:w-1/2">
                            <div class="border border-purple-100 rounded-lg p-4 bg-purple-50 cursor-pointer hover:bg-purple-100 transition-colors"
                                 onclick="document.getElementById('inquiry-type').value='代行相談';">
                                <div class="text-center">
                                    <span class="text-2xl mb-2 block">🤝</span>
                                    <h3 class="font-bold text-gray-900 mb-2">代行相談</h3>
                                    <p class="text-sm text-gray-600">
                                        民泊運営代行に関する<br>
                                        ご相談・一括お見積もり
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 選択値を格納する隠しフィールド（CF7側で name="inquiry-type" の項目がある場合に反映） -->
                    <input type="hidden" id="inquiry-type" name="inquiry-type" />
                </div>
            </div>

            <!-- 参照元情報の表示（宿泊施設などから遷移した場合） -->
            <?php
            $ref_type = isset($_GET['ref_type']) ? sanitize_text_field($_GET['ref_type']) : '';
            $hotel_name = isset($_GET['hotel_name']) ? sanitize_text_field($_GET['hotel_name']) : '';
            $hotel_id = isset($_GET['hotel_id']) ? intval($_GET['hotel_id']) : 0;
            $ref_url = isset($_GET['ref_url']) ? esc_url_raw($_GET['ref_url']) : '';
            
            if ($ref_type && $hotel_name) :
            ?>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">お問い合わせ対象</p>
                            <p class="text-gray-700 mt-1">
                                <?php if ($ref_type === 'hotel') : ?>
                                    🏨 宿泊施設：<strong><?php echo esc_html($hotel_name); ?></strong>
                                <?php elseif ($ref_type === 'company') : ?>
                                    🏢 運営会社：<strong><?php echo esc_html($hotel_name); ?></strong>
                                <?php endif; ?>
                            </p>
                            <?php if ($ref_url) : ?>
                                <p class="text-sm text-gray-600 mt-1">
                                    <a href="<?php echo esc_url($ref_url); ?>" class="text-primary-600 hover:text-primary-700">
                                        ← 元のページに戻る
                                    </a>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Contact Form 7 -->
            <?php 
            if (function_exists('wpcf7_contact_form')) {
                echo do_shortcode('[contact-form-7 id="8dfeb0a" title="お問い合わせフォーム"]');
            } else {
                echo '<div class="text-center text-red-600 p-4 border border-red-200 rounded-lg">';
                echo 'Contact Form 7プラグインが有効化されていません。<br>';
                echo 'プラグインを有効化してください。';
                echo '</div>';
            }
            ?>
            
            <!-- 参照元情報を格納する隠しフィールド -->
            <input type="hidden" id="ref-type" value="<?php echo esc_attr($ref_type); ?>">
            <input type="hidden" id="ref-id" value="<?php echo esc_attr($hotel_id); ?>">
            <input type="hidden" id="ref-name" value="<?php echo esc_attr($hotel_name); ?>">
            <input type="hidden" id="ref-url" value="<?php echo esc_attr($ref_url); ?>">

            <!-- 補足情報 -->
            <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">お問い合わせについて</h2>
                <div class="space-y-4 text-gray-600">
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">📝</span>
                        <div>
                            <span class="font-semibold block">受付時間</span>
                            24時間受付可能です。回答は営業時間内（平日10:00-18:00）となります。
                        </div>
                    </div>
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">⏱</span>
                        <div>
                            <span class="font-semibold block">回答までの目安</span>
                            通常2-3営業日以内にご返信いたします。混雑状況により前後する場合がございます。
                        </div>
                    </div>
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">✉️</span>
                        <div>
                            <span class="font-semibold block">自動返信メール</span>
                            お問い合わせ後、確認メールが自動送信されます。届かない場合は、迷惑メールフォルダをご確認ください。
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- クリック時の見た目切り替え & GTM計測イベント -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inquiryTypes = document.querySelectorAll('.cursor-pointer');
    inquiryTypes.forEach(type => {
        type.addEventListener('click', function() {
            inquiryTypes.forEach(t => {
                t.classList.remove('ring-2', 'ring-blue-500');
            });
            this.classList.add('ring-2', 'ring-blue-500');
        });
    });

    // LINE CTA 計測（必要なければ削除OK）
    const lineCta = document.getElementById('line-cta-contact');
    if (lineCta) {
        lineCta.addEventListener('click', function() {
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'line_cta_click',
                position: 'contact_header',
                page_type: 'contact'
            });
        });
    }

    // URLパラメーターの取得
    const urlParams = new URLSearchParams(window.location.search);
    const subject = urlParams.get('subject');
    
    // 件名フィールドに自動入力
    if (subject) {
        const subjectField = document.querySelector('input[name="your-subject"]');
        if (subjectField) {
            subjectField.value = decodeURIComponent(subject);
        }
    }

    // 参照元情報をContact Form 7のフォームに追加
    function addReferenceInfoToForm() {
        const form = document.querySelector('.wpcf7-form');
        if (!form) {
            setTimeout(addReferenceInfoToForm, 100);
            return;
        }

        const refType = document.getElementById('ref-type').value;
        const refId = document.getElementById('ref-id').value;
        const refName = document.getElementById('ref-name').value;
        const refUrl = document.getElementById('ref-url').value;

        if (refType && refName) {
            // 既存の隠しフィールドをチェック
            let refInfoField = form.querySelector('input[name="reference-info"]');
            if (!refInfoField) {
                refInfoField = document.createElement('input');
                refInfoField.type = 'hidden';
                refInfoField.name = 'reference-info';
                form.appendChild(refInfoField);
            }

            // 参照元情報をまとめて設定
            const refInfo = [];
            if (refType === 'hotel') {
                refInfo.push('【お問い合わせ元】宿泊施設');
            } else if (refType === 'company') {
                refInfo.push('【お問い合わせ元】運営会社');
            }
            refInfo.push('施設名: ' + refName);
            refInfo.push('ID: ' + refId);
            refInfo.push('URL: ' + refUrl);
            
            refInfoField.value = refInfo.join('\n');
        }
    }

    // Contact Form 7が読み込まれたら実行
    setTimeout(addReferenceInfoToForm, 500);
});
</script>

<?php get_footer(); ?>
