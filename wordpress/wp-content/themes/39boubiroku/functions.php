<?php

// アイキャッチ画像の有効化
add_theme_support('post-thumbnails');

// フロントエンド表示時、管理バーを画面下部に固定するCSSを読み込む
function bottom_admin_bar_styles() {
    if (is_admin_bar_showing() && !is_admin()) {
        wp_enqueue_style('custom-admin-bar', get_template_directory_uri() . '/custom-admin-bar.css', array(), '1.0.1');
    }
}
add_action('wp_enqueue_scripts', 'bottom_admin_bar_styles');

// メインのCSSファイルを読み込む
function theme_styles() {
    wp_enqueue_style(
        'main-style', 
        get_template_directory_uri() . '/src/styles/index.css',
        array(), 
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'theme_styles');

// Google Fonts（しっぽり明朝）をパフォーマンスを最適化して読み込む
function enqueue_google_fonts() {
    // Google Fontsのlinkタグにcrossorigin属性を追加するフィルター
    add_filter('style_loader_tag', 'add_preconnect_for_google_fonts', 10, 2);
    
    // Google Fonts用のdns-prefetchとpreconnectを追加するアクション
    add_action('wp_head', 'add_dns_prefetch_and_preconnect', 0);
    
    // フォント本体を読み込む
    wp_enqueue_style(
        'google-fonts-shippori-mincho', 
        'https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;700&display=swap&subset=japanese&display=swap', 
        array(), 
        null
    );
}
add_action('wp_enqueue_scripts', 'enqueue_google_fonts');

// Google Fonts用のdns-prefetchとpreconnectを<head>に追加
function add_dns_prefetch_and_preconnect() {
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">';
    echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    
    // フォントプリロード機能を有効にする場合は以下を有効化
    // require_once get_template_directory() . '/src/fonts/preload.php';
    // preload_google_fonts();
}

// Google Fontsのlinkタグにcrossorigin属性を追加
function add_preconnect_for_google_fonts($html, $handle) {
    if ('google-fonts-shippori-mincho' === $handle) {
        return str_replace(
            "rel='stylesheet'",
            "rel='stylesheet' crossorigin",
            $html
        );
    }
    return $html;
}
