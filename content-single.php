<?php
/**
 * The template for displaying single posts.
 *
 * @package GeneratePress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php generate_do_microdata( 'article' ); ?>>
	<div class="inside-article">
		<?php
		/**
		 * generate_before_content hook.
		 *
		 * @since 0.1
		 *
		 * @hooked generate_featured_page_header_inside_single - 10
		 */
		do_action( 'generate_before_content' );
		?>

		<header class="entry-header">
			<?php
			/**
			 * generate_before_entry_title hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_entry_title' );

			if ( generate_show_title() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			}

			/**
			 * generate_after_entry_title hook.
			 *
			 * @since 0.1
			 *
			 * @hooked generate_post_meta - 10
			 */
			do_action( 'generate_after_entry_title' );
			?>

			<ul class="header-buttons">
				<?php if( get_field('community_link') ): ?>
				<li><a class="far fa-download" title="Discuss this in the community" target="_blank" href="<?php the_field('community_link')?>">
					<svg class="sjmd-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><defs><style>.cls-1{fill:#67c2e7;}.cls-2{fill:#fff;}</style></defs><title>Community Shortcut</title><path class="cls-1" d="M55.35,5.1H8.65a6.51,6.51,0,0,0-6.54,6.49V41.28a6.51,6.51,0,0,0,6.54,6.49h6.89V58.9L25.89,47.77H55.35a6.51,6.51,0,0,0,6.54-6.49V11.59A6.51,6.51,0,0,0,55.35,5.1Z"/><path class="cls-2" d="M16,22.19a4.21,4.21,0,1,1-4.2,4.2A4.21,4.21,0,0,1,16,22.19Z"/><path class="cls-2" d="M32,22.19a4.21,4.21,0,1,1-4.21,4.2A4.2,4.2,0,0,1,32,22.19Z"/><circle class="cls-2" cx="47.96" cy="26.39" r="4.2"/></svg>
				</a></li>
				<?php endif;?>
			</ul>
		</header><!-- .entry-header -->

		<?php
		/**
		 * generate_after_entry_header hook.
		 *
		 * @since 0.1
		 *
		 * @hooked generate_post_image - 10
		 */
		do_action( 'generate_after_entry_header' );
		?>

		<div class="entry-content" itemprop="text">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'generatepress' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<?php
		/**
		 * generate_after_entry_content hook.
		 *
		 * @since 0.1
		 *
		 * @hooked generate_footer_meta - 10
		 */
		do_action( 'generate_after_entry_content' );

		/**
		 * generate_after_content hook.
		 *
		 * @since 0.1
		 */
		do_action( 'generate_after_content' );
		?>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
