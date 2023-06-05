<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>


<div class="wrap">
    <div class="tags" style="display:flex;flex-wrap: wrap;margin: -5px -5px 20px;">
        <?php
        foreach ( get_term_children( get_queried_object()->term_id, 'cities' ) ?: [] as $term_child_id ) :
	        /**
	         * @var WP_Term
	         */
            $term = get_term( $term_child_id );?>

            <div class="tag" style="padding: 5px">
                <a class="tag-content" href="<?php echo esc_url( get_term_link($term_child_id) ) ?>" style="display: block;border:1px solid black;border-radius: 5px;padding: 5px"><?php echo $term->name ?></a>
            </div>
        <?php endforeach; ?>
    </div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :
			?>
			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/trash-dot/content' );

			endwhile;

			the_posts_pagination(
				array(
					/* translators: Hidden accessibility text. */
					'prev_text'          => net_mysory_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'net_mysory' ) . '</span>',
					/* translators: Hidden accessibility text. */
					'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'net_mysory' ) . '</span>' . net_mysory_get_svg( array( 'icon' => 'arrow-right' ) ),
					/* translators: Hidden accessibility text. */
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'net_mysory' ) . ' </span>',
				)
			);

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>
            <style>
                #main > article {
                    width: 100% !important;
                }
            </style>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();
