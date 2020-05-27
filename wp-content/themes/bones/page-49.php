<?php get_header(); ?>

			<div id="content" class="page-49">
			
				<div id="left-content">
				
					<?php
					$participants = 49; // ID of participants-page
					?>
					<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
							
							<header class="article-header">

								<h2 class="page-title"><?php the_title(); ?></h2>
								<h3 class="page-subtitle"><?php echo get_post_meta(get_the_ID(), '_participants_pagesubtitle', true); ?></h3>

							</header>

							<section class="entry-content cf">
								<?php the_content(); ?>
							</section>
						</article>

						<?php endwhile; ?>


						<?php else : ?>

						<?php endif; ?>


					</main>
				</div>
			</div>
		<?php if (is_home() ){ ?>
		</div> <!-- end left (from header) -->
		<?php } ?>
<?php get_footer(); ?>
