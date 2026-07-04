<?php
/**
 * Finexiah Theme functions and definitions
 */

if ( ! defined( 'FINEXIAH_VERSION' ) ) {
	define( 'FINEXIAH_VERSION', '1.0.0' );
}

/* ---------------------------------------------------------
 * Theme Setup
 * --------------------------------------------------------- */
function finexiah_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );

	set_post_thumbnail_size( 1200, 675, true );
	add_image_size( 'finexiah-hero', 1200, 800, true );
	add_image_size( 'finexiah-card', 600, 338, true );
	add_image_size( 'finexiah-thumb', 120, 120, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'finexiah' ),
		'footer-categories' => __( 'Footer — Categories', 'finexiah' ),
		'footer-company'    => __( 'Footer — Company', 'finexiah' ),
		'footer-legal'      => __( 'Footer — Legal', 'finexiah' ),
	) );
}
add_action( 'after_setup_theme', 'finexiah_setup' );

/* ---------------------------------------------------------
 * Scripts & Styles
 * --------------------------------------------------------- */
function finexiah_scripts() {
	wp_enqueue_style( 'finexiah-fonts', 'https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'finexiah-main', get_template_directory_uri() . '/assets/css/main.css', array(), FINEXIAH_VERSION );
	wp_enqueue_style( 'finexiah-style', get_stylesheet_uri(), array(), FINEXIAH_VERSION );
	wp_enqueue_script( 'finexiah-main', get_template_directory_uri() . '/assets/js/main.js', array(), FINEXIAH_VERSION, true );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'finexiah_scripts' );

/* ---------------------------------------------------------
 * Widget Areas
 * --------------------------------------------------------- */
function finexiah_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Article Sidebar', 'finexiah' ),
		'id'            => 'sidebar-article',
		'description'   => __( 'Appears on single posts and archive pages.', 'finexiah' ),
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'finexiah_widgets_init' );

/* ---------------------------------------------------------
 * Helper: reading time
 * --------------------------------------------------------- */
function finexiah_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes = max( 1, round( $word_count / 200 ) );
	return $minutes;
}

/* ---------------------------------------------------------
 * Helper: primary category for a post
 * --------------------------------------------------------- */
function finexiah_primary_category( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$cats = get_the_category( $post_id );
	if ( ! empty( $cats ) ) {
		return $cats[0];
	}
	return null;
}

/* ---------------------------------------------------------
 * Helper: chip color rotation based on category
 * --------------------------------------------------------- */
function finexiah_chip_class( $cat_slug = '' ) {
	$map = array(
		'crypto'   => 'chip--blue',
		'markets'  => 'chip--green',
		'finance'  => 'chip--green',
		'tech'     => 'chip--blue',
		'security' => 'chip--navy',
	);
	return isset( $map[ $cat_slug ] ) ? $map[ $cat_slug ] : 'chip--blue';
}

/* ---------------------------------------------------------
 * Excerpt length / more
 * --------------------------------------------------------- */
add_filter( 'excerpt_length', function( $length ) { return 22; } );
add_filter( 'excerpt_more', function( $more ) { return '&hellip;'; } );

/* ---------------------------------------------------------
 * Custom comment markup callback
 * --------------------------------------------------------- */
function finexiah_comment( $comment, $args, $depth ) {
	?>
	<li <?php comment_class( 'comment-item' ); ?> id="comment-<?php comment_ID(); ?>">
		<div class="avatar-dot" style="width:38px;height:38px;">
			<?php echo get_avatar( $comment, 38 ); ?>
		</div>
		<div>
			<span class="comment-author"><?php comment_author(); ?></span>
			<span class="comment-time"><?php echo human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ); ?> ago</span>
			<div class="comment-text"><?php comment_text(); ?></div>
		</div>
	</li>
	<?php
}

/* ---------------------------------------------------------
 * Register Customizer settings for site tagline/social/newsletter
 * --------------------------------------------------------- */
function finexiah_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'finexiah_footer', array(
		'title'    => __( 'Finexiah — Footer & Social', 'finexiah' ),
		'priority' => 130,
	) );

	$wp_customize->add_setting( 'finexiah_footer_desc', array(
		'default' => 'Independent journalism delivering precision analysis at the intersection of Silicon Valley and Wall Street.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'finexiah_footer_desc', array(
		'label' => __( 'Footer Description', 'finexiah' ),
		'section' => 'finexiah_footer',
		'type' => 'textarea',
	) );

	foreach ( array( 'twitter', 'rss', 'linkedin' ) as $net ) {
		$wp_customize->add_setting( 'finexiah_social_' . $net, array( 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( 'finexiah_social_' . $net, array(
			'label' => ucfirst( $net ) . ' URL',
			'section' => 'finexiah_footer',
			'type' => 'url',
		) );
	}

	$wp_customize->add_setting( 'finexiah_newsletter_action', array( 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'finexiah_newsletter_action', array(
		'label' => __( 'Newsletter Form Action URL (Mailchimp etc.)', 'finexiah' ),
		'section' => 'finexiah_footer',
		'type' => 'url',
	) );
}
add_action( 'customize_register', 'finexiah_customize_register' );

/* ---------------------------------------------------------
 * Fallback menu for primary nav if none assigned
 * --------------------------------------------------------- */
function finexiah_fallback_menu() {
	echo '<ul class="primary-nav">';
	$cats = get_categories( array( 'number' => 4, 'hide_empty' => false ) );
	foreach ( $cats as $cat ) {
		echo '<li><a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
	}
	echo '</ul>';
}

/* ---------------------------------------------------------
 * Content width
 * --------------------------------------------------------- */
if ( ! isset( $content_width ) ) {
	$content_width = 720;
}
