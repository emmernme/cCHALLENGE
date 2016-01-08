<?php get_header(); ?>

			<div id="content">
			
				<div id="left-content">
				
					<?php
					$participants = 49; // ID of participants-page
					?>
					<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
							
							<header class="article-header">

								<h2 class="page-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<h3 class="page-subtitle"><?php echo get_post_meta(get_the_ID(), '_participants_pagesubtitle', true); ?></h3>

							</header>

							<section class="entry-content cf">
								<?php the_content(); ?>
							</section>
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
											<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>

						<?php endif; ?>


					</main>
				</div>
			</div>
		<?php if (is_home()){ ?>
		</div> <!-- end left (from header) -->
		<?php } ?>
<?php get_footer(); ?>
