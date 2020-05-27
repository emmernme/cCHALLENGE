<?php
/*
 * SINGLE for the inspiration post format
*/
?>

<?php get_header();
	$post_id = get_queried_object_id();
	$author = get_post_field( 'post_author', $post_id );
	$email = get_the_author_meta('user_email', $author);
?>


			<div id="content">
				<div id="left-content" class="content">
					<div id="to-overview"><a href="<?php echo get_post_type_archive_link('reflection'); ?>">Back to overview</a></div>
					<h2 id="author-name"><span class="author-pre">Author:</span><br /><?php the_author_meta('display_name', $author); ?></h2>
					<p id="author-email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
					<hr />
					<?php share_box($author, $post_id); ?>
				</div><div id="right-content" class="content">
					<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">


							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="article-header">
									<h3 class="h2"><?php the_title(); ?></h3>
								</header>

								<section class="entry-content cf">

									<?php the_content(); ?>

								</section>

								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; ?>
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
