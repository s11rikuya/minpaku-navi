<form role="search" method="get" class="search-form relative" action="<?php echo home_url('/'); ?>">
    <label class="sr-only">
        <?php echo _x('検索:', 'label', 'minpaku-portal') ?>
    </label>
    <div class="relative">
        <input type="search" class="w-full pl-10 pr-4 py-2 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" 
            placeholder="<?php echo esc_attr_x('記事を検索...', 'placeholder', 'minpaku-portal') ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x('検索:', 'label', 'minpaku-portal') ?>" />
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>
    <button type="submit" class="absolute inset-y-0 right-0 px-3 flex items-center bg-primary-600 text-white rounded-r-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors">
        <span class="sr-only"><?php echo esc_attr_x('検索', 'submit button', 'minpaku-portal') ?></span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
</form> 