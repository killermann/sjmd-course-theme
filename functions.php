<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );

function tu_remove_footer_area() {
    remove_action( 'generate_footer','generate_construct_footer' );
}

add_action( 'after_setup_theme', 'tu_remove_footer_area' );

// Custom Login Page

function put_my_url(){
	return ('https://course.sjmd.space'); // putting my URL in place of the WordPress one
}
add_filter('login_headerurl', 'put_my_url');

// changing the login page URL hover text
function put_my_title(){
	return ('Social Justice, Minus Dogma Course + Community'); // changing the title from "Powered by WordPress" to whatever you wish
}
add_filter('login_headertitle', 'put_my_title');


function generate_login_logo() { ?>
    <style type="text/css">

		.login {
			background: white;
		}

		.login #loginform {
			box-shadow: none;
			border-radius: 60px;
		}
        .login h1 a {
			width: 100% !important;
			max-width: 240px !important;
			height: 80px !important;
			margin: 0 auto;
			background-size: contain !important;
            background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/img/logo-sjmd-course.svg') !important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'generate_login_logo' );
