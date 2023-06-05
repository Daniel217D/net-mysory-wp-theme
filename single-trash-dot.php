<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
	<div id="primary" class="content-area">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
		?>

		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        <span>Опубликовано <?php echo get_the_date() ?></span>
                    </header><!-- .entry-header -->
                    <div class="entry-content">
                        <div style="display: flex; margin-bottom: 10px;">
                            <img src="<?php echo get_field( 'main_photo' ) ?>" style="width: 80%; padding-right: 10px">
                            <div style="width: calc(20%-10px); display:flex; flex-direction: column;" class="trash-images">
                            <?php foreach ( get_field( 'additional_photos' ) as $photo ): ?>
                                <img src="<?php echo $photo['photo'] ?>" style="width: 100%;">
                            <?php endforeach;?>
                            </div>
                        </div>
                        <style>
                            .trash-images > img:not(:last-of-type) {
                                margin-bottom: 10px;
                            }
                        </style>

						<?php
						the_content();
						?>

                        <div style="margin-bottom: 10px;">Расположение: <?php echo get_field('place') ?></div>

                        <div id="map-in-post" class="loading" style="height: 400px; margin-bottom: 10px;" data-coords='<?= json_encode(get_field('coordinates')['marks'][0]['coords']) ?>'></div>

                        <?php

                        if( get_field('cleaned') ) : ?>
                            <div style="margin-bottom: 10px;">Статус: мусор убран</div>
                        <?php else: ?>
                            <div style="margin-bottom: 10px;">Статус: мусор не убран</div>
                        <?php endif; ?>

                        <?php
                        $administration_response = get_field('administration_response');
                        if(empty( $administration_response )) : ?>
                            <div style="margin-bottom: 10px;">Ответ от местной администрации не получен</div>
                        <?php else: ?>
                            <div style="margin-bottom: 10px;">Ответ от местной администрации:</div>
                            <?php echo $administration_response ?>
                        <?php endif; ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-<?php the_ID(); ?> -->

				<?php

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
