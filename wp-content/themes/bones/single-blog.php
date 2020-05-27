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

<?php
	//DISABLED - will redirect to author page UNLESS preview
	$post_id = get_queried_object_id();
	$author = get_post_field( 'post_author', $post_id );
	$author_archive = get_author_posts_url($author);
	if (!is_preview() && strpos($_SERVER["HTTP_USER_AGENT"], "facebookexternalhit/") === false && strpos($_SERVER["HTTP_USER_AGENT"], "Facebot") === false){
		wp_redirect($author_archive . '?'.$_SERVER['QUERY_STRING']);
		exit();
	}
	get_header();
?>

			<div id="content">

				<div id="left-content" class="content">
					<div id="to-overview"><a href="<?php echo get_page_link(49); ?>">Back to overview</a></div>
					<?php echo get_avatar($author, 512); ?>
					<h2 id="author-name"><?php echo get_the_author_meta('display_name', $author); ?></h2>
					<p id="author-challenge">My cCHANGE challenge:<br/><?php the_author_meta('cCHALLENGE', $author); ?></p>
					<hr />
					<p id="author-bio"><?php the_author_meta('description', $author); ?></p>
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
