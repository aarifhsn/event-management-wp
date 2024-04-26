<?php
/**
 * event-management functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package event-management
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function event_management_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on event-management, use a find and replace
		* to change 'event-management' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'event-management', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'event-management' ),
			'footer_menu' => esc_html__( 'Footer Menu', 'event-management' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'event_management_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'event_management_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function event_management_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'event_management_content_width', 640 );
}
add_action( 'after_setup_theme', 'event_management_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function event_management_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'event-management' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'event-management' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'event_management_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function event_management_scripts() {
	wp_enqueue_style( 'event-management-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'event-management-style', 'rtl', 'replace' );

	wp_enqueue_script( 'event-management-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'event_management_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * WooCommerce.
 */
include_once get_template_directory() . '/inc/woocommerce.php';

/**
 * Shortcodes.
 */
include_once get_template_directory() . '/inc/shortcodes.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// conditional page redirect for users
function register_page_login_check() {
	$registration_page_id= 1936;
	if (function_exists('wc_get_page_id')) {
		$my_account_page_id = wc_get_page_id('myaccount');

		if(!is_user_logged_in() && is_page($registration_page_id)) {
			wp_redirect(get_permalink($my_account_page_id));
			exit;
		}
	} 
}
add_action('template_redirect', 'register_page_login_check');

// input field function

function event_management_input($name, $label, $type, $required = false, $options = [] ) {
	$html = '<label class="event_management_label" for="'.$name.'">'.$label;
	
	if($required) {
		$html .= '<span class="text-red-500 ml-1">*</span>';
	}
	
	$html .='</label>';
	if($type == 'select') {
		$html .= '<select id="'.$name.'" name="'.$name.'" class="event_management_input">';
		foreach($options as $option) {
			$html .= '<option value="'.$option.'">'.$option.'</option>';
		}
		$html .='</select>';
	} else {
		if(isset($_SESSION[$name])) {
			$value = $_SESSION[$name];
		} else {
			$value = '';
		}
		$html .='<input id="'.$name.'" name="'.$name.'" class="event_management_input" type="'.$type.'" value="'.$value.'">';

	}

	if(isset($_SESSION[$name .'_error'])) {
		$html .= '<p class="text-red-500 text-sm mt-2">'.$_SESSION[$name .'_error'].'</p>';
		unset($_SESSION[$name .'_error']);
	}
	return $html;
}

function event_manage_validate_fields($fields =[]) {
	foreach($fields as $field) {
		if(isset($_POST[$field]) && empty($_POST[$field])) {
			$_SESSION[$field . '_error']= "This Field is required ";
		} else {
			$_SESSION[$field] = $_POST[$field];
		}
	}
}


function event_mng_save_registration_data() {
	// validate nonce
	$registration_page_id = 1936;
	if(isset($_POST['registration_data_nonce']) && !wp_verify_nonce($_POST['registration_data_nonce'], 'registration_data_nonce')) {
		$_SESSION['nonce_error'] = 'Nonce Verification Failed';
	}

	 // Store form data in session variables
	 foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
    }

	// validate data
	event_manage_validate_fields(['team_name', 'head_coach_full_name', 'head_coach_mobile_number','head_coach_email', 'city', 'state', 'pool_play_days', 'age_division' ]);

	// validation failed data
		// redirect to registration page with error message

	// validation passed
		// sanitize data
		// save data to database
		// redirect to registration page with success message
	wp_redirect(get_permalink($registration_page_id));
	exit;
}
add_action('admin_post_registration_data', 'event_mng_save_registration_data');

// session start if not
function event_mng_session_init() {
	if(!session_id()) {
		session_start();
	}
}
add_action('init', 'event_mng_session_init');