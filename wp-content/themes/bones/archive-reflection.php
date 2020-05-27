<?php
/*
 * CUSTOM POST TYPE ARCHIVE TEMPLATE
 *
 * This is the custom post type archive template. If you edit the custom post type name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is called "register_post_type( 'bookmarks')",
 * then your template name should be archive-bookmarks.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">
				<h1 class="archive-title"><?php post_type_archive_title(); ?></h1>
				
				<main id="main" class="article" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<?php if (have_posts()) : while (have_posts()) : the_post();

						?><article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
							<?php if ($thumbnail = find_img_src($post)) { ?>
							<div class="cf blog-image"><img src="<?php echo $thumbnail; ?>" /></div>
							<?php } ?>
							<header class="article-header">
								<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							</header>

							<section class="entry-content cf">
								<?php the_excerpt(); ?>
							</section>
							<div class="bottom-line"></div>
						</article><div class="archive-spacer"></div><?php
						endwhile; ?>

								<?php bones_page_navi(); ?>

						<?php else : ?>

								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the custom posty type archive template.', 'bonestheme' ); ?></p>
									</footer>
								</article>

						<?php endif; ?>

					</main>
				</div>

			</div>

<?php get_footer(); ?>
