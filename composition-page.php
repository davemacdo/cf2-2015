<?php
/*

Template Name: Composition Page

*/
add_filter('wp_title', 'composition_page_title');
get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><span class="composer"><?php the_composition("composer"); ?>:</span> <br><span class="composition-title"><?php the_composition("title"); ?></span></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php cf_media(); ?>
						<?php cf_score(); ?>
						<?php the_content(); ?>
						<?php cf_site(); ?>
						<p>If you would like to contact the composer about performing their music or commissioning a new one, please get in touch with us at <a href="mailto:cfcomposers@gmail.com">cfcomposers@gmail.com</a>.</p>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php //comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>