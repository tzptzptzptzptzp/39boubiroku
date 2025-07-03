<?php

// アイキャッチ画像をサポート
add_theme_support('post-thumbnails');

// 管理バーのカスタムCSS（下部に固定表示）をロード
function bottom_admin_bar_styles() {
    // フロントエンド表示時のみ、管理バーを下部に表示するCSSを適用
    if (is_admin_bar_showing() && !is_admin()) {
        wp_enqueue_style('custom-admin-bar', get_template_directory_uri() . '/custom-admin-bar.css', array(), '1.0.1');
    }
}
// フロントエンドのみにフック
add_action('wp_enqueue_scripts', 'bottom_admin_bar_styles');

// 管理画面用のスタイルをロード
function admin_styles() {
    if (is_admin_bar_showing() && is_admin()) {
        wp_enqueue_style('admin-style', get_template_directory_uri() . '/admin-style.css', array(), '1.0.0');
    }
}
add_action('admin_enqueue_scripts', 'admin_styles');

// テーマのメインスタイルシートを読み込み
function theme_styles() {
    // メインのスタイルシート
    wp_enqueue_style(
        'main-style', 
        get_template_directory_uri() . '/src/styles/index.css',
        array(), 
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'theme_styles');

