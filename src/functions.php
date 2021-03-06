<?php
// Globals
/**
 * @var (string) $version css and js version
*/
$version = '1.0.0';
$template_directory_uri = get_template_directory_uri();
$template_directory = get_template_directory();
$site_url = site_url();
$img_url = $template_directory_uri . '/img';
$screen_widths = ['0', '576', '768', '1024', '1280'];

$upload_dir = wp_get_upload_dir();

/**
 * @var (string) $upload_basedir /public_html/wp-content/uploads/
*/
$upload_basedir = $upload_dir['basedir'] . DIRECTORY_SEPARATOR;

/**
 * @var (string) $upload_baseurl http://site.com/wp-content/uploads/
 */
$upload_baseurl = $upload_dir['baseurl'] . DIRECTORY_SEPARATOR;

$tel_regex = '/\s/';
$tel = get_option( 'contacts_tel' );
$tel_clean = preg_replace( $tel_regex, '', $tel );
$api_email = get_option( 'contacts_api_email' );
$hr_email = get_option( 'contacts_hr_email' );

$logo_id = get_theme_mod( 'custom_logo' );
$logo_url = wp_get_attachment_url( $logo_id );


$preload_styles = [];

/**
 * @var (bool) $webp_support
 * true if browser support the WebP image format
 */
$webp_support = strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false || strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/' ) !== false;

require $template_directory . '/inc/create-logotype-image.php';

// Создание <link rel="preload" /> для img
require $template_directory . '/inc/create-link-preload.php';

// Активация SVG и WebP в админке
require $template_directory . '/inc/enable-svg-and-webp.php';

// Регистрация стилей и скриптов для страниц и прочие манипуляции с ними
require $template_directory . '/inc/enqueue-styles-and-scripts.php';

// Отключение стандартных скриптов и стилей, гутенберга, emoji и т.п.
require $template_directory . '/inc/disable-wp-scripts-and-styles.php';

// Регистрация меню на сайте
require $template_directory . '/inc/menus.php';

// Регистрация доп. полей в меню Настройки->Общее
require $template_directory . '/inc/options-fields.php';

// Регистрация и изменение записей и таксономий
require $template_directory . '/inc/register-custom-posts-types-and-taxonomies.php';

// Нужные поддержки темой, рамзеры для нарезки изображений
require $template_directory . '/inc/theme-support-and-thumbnails.php';

// Склеивание путей с правильным сепаратором
require $template_directory . '/inc/php-path-join.php';

// Определение шаблона страницы
require $template_directory . '/inc/define-template.php';

// Отключение обновления плагинов
require $template_directory . '/inc/disable-update-plugins.php';

// Передача в JS переменных с url и path сайта
require $template_directory . '/inc/print-site-data-js.php';


/**
 * blocks
 */
require $template_directory . '/blocks/fail-block.php';
require $template_directory . '/blocks/success-block.php';
require $template_directory . '/blocks/contacts-block.php';

if ( is_super_admin() || is_admin_bar_showing() ) {

	// Функция формирования стилей и скриптов для страницы при сохранении страницы
	require $template_directory . '/inc/build-styles-scripts.php';

	// Функция создания webp и минификации изображений
	require $template_directory . '/inc/generate-images.php';

	// Формирование файла pages-info.json, для понимания на какой странице какие секции используются
	require $template_directory . '/inc/build-pages-info.php';

	// Удаление лишних пунктов из меню админ-панели и прочие настройки админ-панели
	require $template_directory . '/inc/admin-menu-actions.php';

}