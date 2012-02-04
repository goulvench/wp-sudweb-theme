<?php
define('THEME_VERSION', '2.0.0-dev');
add_theme_support('post-thumbnails');

/*
 * Requires bundled WP-LESS for LESS stylesheet parsing features
 */
if (false === class_exists('WPLessPlugin'))
{
	require __DIR__.'/vendor/wp-less/bootstrap-for-theme.php';
	$WPLessPlugin->dispatch();
}

/*
 * Declaring Sidebars
 */
register_sidebar(array(
	'name' => 'Header',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
));

/*
 * Declaring Menus
 */
register_nav_menu('header', 'Primary Navigation');

/*
 * Register actions
 */
add_action('wp', 'theme_main_action');
add_filter('nav_menu_css_class', 'filter_navmenu_classes', 10, 3);

function theme_main_action(){
    wp_enqueue_style('main', get_stylesheet_directory_uri().'/style.less', array(), 'THEME_VERSION', 'media,screen');
}

/**
 * Adds some CSS classes to given menu elements
 *
 * @uses bootsrap responsive
 * @see http://codex.wordpress.org/Function_Reference/wp_nav_menu
 * @param array $classes
 * @param $item
 * @param $args Menu arguments
 * @return array CSS classes
 */
function filter_navmenu_classes(array $classes, $item, $args)
{
	if ($args->theme_location === 'header')
	{
		$classes[] = 'span6';
	}

	return $classes;
}
