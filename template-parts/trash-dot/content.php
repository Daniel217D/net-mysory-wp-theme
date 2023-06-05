<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_sticky() && is_home() ) :
		echo net_mysory_get_svg( array( 'icon' => 'thumb-tack' ) );
	endif;
	?>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
			if ( is_single() ) {
				net_mysory_posted_on();
			} else {
				echo net_mysory_time_link();
				net_mysory_edit_link();
			}
			echo '</div><!-- .entry-meta -->';
		}

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'net_mysory-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<a class="entry-content" style="display:block;" href="<?php echo esc_url( get_permalink() ) ?>">
        <img src="<?php echo get_field( 'main_photo' ) ?>" style="width: 20%; padding-right: 10px; padding-bottom: 10px; float:left">
		<?php
        echo get_field( 'summary' );

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'net_mysory' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>
	</a><!-- .entry-content -->

	<?php
	if ( is_single() ) {
		net_mysory_entry_footer();
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->
