<?php
/**
 * テーマのセットアップ
 */
function neko_theme_setup() {
    // タイトルタグ（<title>）の出力.
    add_theme_support( 'title-tag' );
    // アイキャッチ画像の有効化.
    add_theme_support( 'post-thumbnails' );
    // 固定ページ・投稿ページのアイキャッチサイズ.
    add_image_size( 'page_eyecatch', 1100, 610, true );
    // 記事一覧のアイキャッチサイズ.
    add_image_size( 'archive_thumbnail', 200, 150, true );
    // カスタムメニュー有効化.
    register_nav_menus( array(
        'main-menu' => 'メインメニュー' ,
        'footer-menu' => 'フッターメニュー'
    ) );
}
add_action( 'after_setup_theme', 'neko_theme_setup' );

/**
 * 外部ファイルの読み込み
 */
function neko_enqueue_scripts(){
    // jQueryを読み込む.
    wp_enqueue_script( 'jquery' );
    // テーマ独自のJavaScriptを読み込む.
    wp_enqueue_script(
        'kuroneko-theme-common',
        get_template_directory_uri() . '/assets/js/theme-common.js',
        array(),
        '1.0.0',
        true
    );
    // Google Fontsを読み込む.
    wp_enqueue_style(
        'googlefonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap',
        array(),
        '1.0.0'
    );
    // テーマ独自のCSSファイルを読み込む.
    wp_enqueue_style(
        'kuroneko-theme-styles',
        get_template_directory_uri() . '/assets/css/theme-styles.css',
        array(),
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'neko_enqueue_scripts' );

/**
 * どのテンプレートファイルが使われているかを表示
 */
function add_adminbar_menu() {
    global $wp_admin_bar;
    global $template;
    $current_template = basename($template);
    $wp_admin_bar->add_node( array(
      'id'    => 'template_file_name',
      'title' => '使用されているテンプレートファイル : '. $current_template,
    ));
  }
  add_action('admin_bar_menu', 'add_adminbar_menu', 500);