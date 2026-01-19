<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-gray-50'); ?>>
<?php wp_body_open(); ?>

<header class="bg-white shadow-sm sticky top-0 z-50">
    <!-- トップバー -->
    <div class="bg-primary-600">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="flex justify-end h-10 items-center space-x-4 text-sm">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="text-white hover:text-primary-100 transition-colors duration-200">
                    お問い合わせ
                </a>
            </div>
        </div>
    </div>

    <!-- メインヘッダー -->
    <div class="border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- サイトロゴ/タイトル -->
                <div class="flex-shrink-0">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center space-x-2">
                            <span class="text-lg sm:text-xl md:text-2xl font-extrabold text-primary-600 hover:text-primary-700 transition-colors duration-200">
                                <?php bloginfo('name'); ?>
                            </span>
                            <?php if (get_bloginfo('description')) : ?>
                                <span class="hidden sm:block text-xs md:text-sm text-gray-500 pl-2 md:pl-3 ml-2 md:ml-3 border-l border-gray-200">
                                    <?php bloginfo('description'); ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- メインナビゲーション -->
                <nav class="hidden md:flex items-center space-x-1">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'items_wrap' => '<div class="flex space-x-1">%3$s</div>',
                        'walker' => new Tailwind_Walker_Nav_Menu(),
                    ));
                    ?>
                    <!-- 検索ボタン -->
                    <button type="button" class="search-toggle ml-6 p-2 text-gray-500 hover:text-primary-600 hover:bg-gray-100 rounded-full transition-colors duration-200">
                        <span class="sr-only">検索を開く</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </nav>

                <!-- モバイルメニューボタン -->
                <div class="flex items-center space-x-3 md:hidden">
                    <button type="button" class="search-toggle p-2 text-gray-500 hover:text-primary-600 hover:bg-gray-100 rounded-full transition-colors duration-200">
                        <span class="sr-only">検索を開く</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                    <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-primary-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 transition-colors duration-200">
                        <span class="sr-only">メニューを開く</span>
                        <!-- ハンバーガーアイコン -->
                        <svg class="menu-icon block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- 閉じるアイコン -->
                        <svg class="close-icon hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 検索オーバーレイ -->
    <div class="search-overlay fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        <div class="absolute inset-x-0 top-0 bg-white shadow-lg transform transition-transform duration-300 -translate-y-full">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-4">
                <div class="relative">
                    <?php get_search_form(); ?>
                    <button type="button" class="search-close absolute right-0 top-0 mt-2 mr-2 p-2 text-gray-500 hover:text-primary-600 hover:bg-gray-100 rounded-full transition-colors duration-200">
                        <span class="sr-only">検索を閉じる</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- モバイルメニュー -->
    <div class="mobile-menu hidden md:hidden overflow-hidden transition-all duration-300 ease-in-out">
        <div class="px-2 pt-2 pb-3 space-y-1 border-t border-gray-200 bg-white shadow-lg">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'items_wrap' => '<div class="space-y-1">%3$s</div>',
                'walker' => new Tailwind_Walker_Nav_Menu(),
            ));
            ?>
        </div>
    </div>
</header>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // モバイルメニューの制御
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');
    const menuIcon = mobileMenuButton.querySelector('.menu-icon');
    const closeIcon = mobileMenuButton.querySelector('.close-icon');

    if (mobileMenuButton && mobileMenu && menuIcon && closeIcon) {
        mobileMenuButton.addEventListener('click', function() {
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                // メニューを開く
                mobileMenu.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                // メニューを閉じる
                mobileMenu.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        // メニュー外をクリックしたら閉じる
        document.addEventListener('click', function(e) {
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            }
        });
    }

    // 検索オーバーレイの制御
    const searchToggles = document.querySelectorAll('.search-toggle');
    const searchOverlay = document.querySelector('.search-overlay');
    
    if (searchOverlay) {
        const searchClose = document.querySelector('.search-close');
        const searchContainer = searchOverlay.querySelector('.transform');

        function openSearch() {
            searchOverlay.classList.remove('hidden');
            setTimeout(() => {
                if (searchContainer) {
                    searchContainer.classList.remove('-translate-y-full');
                    const searchInput = searchOverlay.querySelector('input[type="search"]');
                    if (searchInput) {
                        searchInput.focus();
                    }
                }
            }, 10);
        }

        function closeSearch() {
            if (searchContainer) {
                searchContainer.classList.add('-translate-y-full');
                setTimeout(() => {
                    searchOverlay.classList.add('hidden');
                }, 300);
            }
        }

        searchToggles.forEach(toggle => {
            toggle.addEventListener('click', openSearch);
        });

        if (searchClose) {
            searchClose.addEventListener('click', closeSearch);
        }

        searchOverlay.addEventListener('click', function(e) {
            if (e.target === searchOverlay) {
                closeSearch();
            }
        });

        // ESCキーでの検索オーバーレイ閉じる
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !searchOverlay.classList.contains('hidden')) {
                closeSearch();
            }
        });
    }
});
</script>

<main class="min-h-screen">
    <div class="site-content max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-8"> 