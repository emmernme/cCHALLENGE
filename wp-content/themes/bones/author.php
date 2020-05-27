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
					<div id="to-overview"><a href="<?php echo get_page_link(49); ?>">Back to overview</a></div>
					<?php echo get_avatar($author->ID, 512); ?>
					<h2 id="author-name"><?php echo $author->display_name; ?></h2>
					<p id="author-challenge">My cCHALLENGE:<br/><?php the_author_meta('cCHALLENGE', $author->ID); ?></p>
					<hr />
					<p id="author-bio"><?php the_author_meta('description', $author->ID); ?></p>
					<hr />
					<?php share_box($author->ID); ?>
				</div><div id="right-content" class="content">
					<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">


							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="article-header">
									<?php $day = get_post_meta(get_the_ID(), '_blog_dayday', true); ?>
									<h3 class="h2"><?php echo ($day)? "Day {$day}: ":''; ?><?php the_title(); ?></a></h3>
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
											<h1><?php echo $author->display_name; ?> hasn't blogged yet!</h1>
										</header>
										<section class="entry-content">
											<h3><?php echo $author->display_name; ?> hasn't started blogging yet. Please come back later.</h3>
										</section>
									</article>

							<?php endif; ?>

						</main>

				</div>

			</div>

<?php get_footer(); ?>
