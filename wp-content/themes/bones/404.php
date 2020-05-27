<?php get_header(); ?>

			<div id="content" class="page-49">
			
				<div id="left-content">
				
					<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
							
							<header class="article-header">

								<h2 class="page-title">Oops</h2>
								<h3 class="page-subtitle">I couldn't find what you were looking for...</h3>

							</header>

							<section class="entry-content cf">
								<p>You can try again or take a look at some of our other <a href="<?php echo get_permalink(49); ?>" title="<?php echo get_the_title(49); ?>">participants here</a>!</p>
							</section>
						</article>

					</main>
				</div>
			</div>
		<?php if (is_home()){ ?>
		</div> <!-- end left (from header) -->
		<?php } ?>
<?php get_footer(); ?>
