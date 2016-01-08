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

<?php get_header();
	$author = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>

			<div id="content">

				<div id="left-content" class="content">
					<div id="to-overview"><a href="#">Back to overview</a></div>
					<?php echo get_avatar($author->ID, 512); ?>
					<h2 id="author-name"><?php echo $author->display_name; ?></h2>
					<p id="author-challenge">My cCHANGE challenge:<br/><?php the_author_meta('cCHALLENGE', $author->ID); ?></p>
					<hr />
					<p id="author-bio"><?php the_author_meta('description', $author->ID); ?></p>
					<hr />
					<div id="author-share">
						<h3>SHARE THIS</h3>
						<a class="share" href="<?php the_author_meta('facebook', $author->ID); ?>" id="facebook"></a>
						<a class="share" href="http://twitter.com/<?php the_author_meta('twitter', $author->ID); ?>" id="twitter"></a>
						<a class="share" href="<?php the_author_meta('linkedin', $author->ID); ?>" id="linkedin"></a>
					</div>
				</div>
				
				<div id="right-content" class="content">
					<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">


							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="article-header">
									<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								</header>

								<section class="entry-content cf">

									<?php the_content(); ?>

								</section>

								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; ?>

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
