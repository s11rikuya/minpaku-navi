<?php
class Tailwind_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));

        // コンテナIDでモバイル/デスクトップを判定
        $is_mobile = false;
        if (is_object($args) && isset($args->theme_location)) {
            // モバイルメニューかどうかを判定（簡易的な方法）
            $is_mobile = false; // デフォルトはデスクトップ
        }

        // デスクトップメニューのスタイル
        $desktop_class = 'text-gray-600 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group';
        
        // モバイルメニューのスタイル  
        $mobile_class = 'text-gray-600 hover:text-primary-600 hover:bg-gray-50 block px-3 py-2 rounded-lg text-base font-medium transition-colors duration-200 w-full text-left';

        // モバイルコンテキストでは常にモバイルスタイルを使用
        $menu_class = $mobile_class . ' md:inline-flex md:items-center md:px-3 md:py-2 md:text-sm md:rounded-none md:hover:bg-transparent md:w-auto';

        $class_names = $class_names ? ' class="' . $menu_class . '"' : ' class="' . $menu_class . '"';

        $output .= '<li' . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        $atts['class']  = 'block w-full text-left md:flex md:items-center';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        // $argsが配列かオブジェクトかを確認して適切にアクセス
        $before = is_object($args) ? $args->before : (isset($args['before']) ? $args['before'] : '');
        $after = is_object($args) ? $args->after : (isset($args['after']) ? $args['after'] : '');
        $link_before = is_object($args) ? $args->link_before : (isset($args['link_before']) ? $args['link_before'] : '');
        $link_after = is_object($args) ? $args->link_after : (isset($args['link_after']) ? $args['link_after'] : '');

        $item_output = $before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $link_before . $title . $link_after;
        
        // 現在のメニューアイテムの下線エフェクト（デスクトップのみ）
        $item_output .= '<span class="hidden md:block absolute bottom-0 left-0 w-full h-0.5 bg-primary-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200 origin-left"></span>';
        
        $item_output .= '</a>';
        $item_output .= $after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
} 