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

function get_header_custom_fields(){
	?>
	<ul class="header-buttons">
		<?php if( get_field('community_link') ): ?>
		<li><a class="far fa-download" title="Discuss this in the community" target="_blank" href="<?php the_field('community_link')?>">
			<svg class="sjmd-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><defs><style>.cls-1{fill:#67c2e7;}.cls-2{fill:#fff;}</style></defs><title>Community Shortcut</title><path class="cls-1" d="M55.35,5.1H8.65a6.51,6.51,0,0,0-6.54,6.49V41.28a6.51,6.51,0,0,0,6.54,6.49h6.89V58.9L25.89,47.77H55.35a6.51,6.51,0,0,0,6.54-6.49V11.59A6.51,6.51,0,0,0,55.35,5.1Z"/><path class="cls-2" d="M16,22.19a4.21,4.21,0,1,1-4.2,4.2A4.21,4.21,0,0,1,16,22.19Z"/><path class="cls-2" d="M32,22.19a4.21,4.21,0,1,1-4.21,4.2A4.2,4.2,0,0,1,32,22.19Z"/><circle class="cls-2" cx="47.96" cy="26.39" r="4.2"/></svg>
		</a></li>
		<?php endif;?>
	</ul>
<?php
}

add_action('learndash-focus-content-title-before','get_header_custom_fields');


/*------------------------------------*\
	Customize Admin Area
\*------------------------------------*/

function remove_dashboard_widgets() {
    global $wp_meta_boxes;

    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['jetpack_summary_widget']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['pressable_dashboard_widget']);
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


function set_default_admin_color($user_id) {
    $args = array(
        'ID' => $user_id,
        'admin_color' => 'blue'
    );
    wp_update_user( $args );
}
add_action('user_register', 'set_default_admin_color');

// removes admin color scheme options
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// remove Personal Options

if ( ! function_exists( 'cor_remove_personal_options' ) ) {
    /**
    * Removes the leftover 'Visual Editor', 'Keyboard Shortcuts' and 'Toolbar' options.
    */
    function cor_remove_personal_options( $subject ) {
        $subject = preg_replace( '#<h2>Personal Options</h2>.+?/table>#s', '', $subject, 1 );
        return $subject;
    }

    function cor_profile_subject_start() {
        ob_start( 'cor_remove_personal_options' );
    }

    function cor_profile_subject_end() {
        ob_end_flush();
    }
}
add_action( 'admin_head', 'cor_profile_subject_start' );
add_action( 'admin_footer', 'cor_profile_subject_end' );

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

// remove_menu_page('edit.php'); // Posts
// remove_menu_page('upload.php'); // Media
// remove_menu_page('link-manager.php'); // Links
// remove_menu_page('edit-comments.php'); // Comments
// remove_menu_page('edit.php?post_type=page'); // Pages
// remove_menu_page('plugins.php'); // Plugins
// remove_menu_page('themes.php'); // Appearance
// remove_menu_page('users.php'); // Users
// remove_menu_page('tools.php'); // Tools
// remove_menu_page('options-general.php'); // Settings
