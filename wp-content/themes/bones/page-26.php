<?php get_header(); 
	// Custom template for the about-page
	$post_id = 26;
?>

<div id="content">
				<div id="left-content" class="content">
					<div id="to-overview"><a href="<?php echo get_home_url(); ?>">Back to overview</a></div>
					<div id="contact-info"><?php echo wpautop(get_post_meta($post_id, '_about_pagecontact', true)); ?></div>
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
							<?php endif; ?>

						</main>

				</div>

			</div>


<?php get_footer(); ?>
