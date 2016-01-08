<?php get_header(); ?>

			<div id="content">
			
				<div id="left-content">
				
					<?php
					$about = 26; // ID of about-page
					$thumb = get_post_thumbnail_id($about);
					$thumb = wp_get_attachment_url($thumb);

					?>
					<div id="about"><div style="background-image:url('<?php echo $thumb;?>')"><h1><a href="<?php get_the_permalink($about) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=>$about)); ?>"><?php echo get_the_title($about); ?></a></h1>
</div></div>
					<main id="main-reflections" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php
						// Set up loop to get reflections. TODO: add tweets etc							
						$args = array( 'post_type' => 'reflection');
						$loop = new WP_Query( $args );

						if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
							
							<?php the_post_thumbnail('large'); ?>

							<header class="article-header">

								<h2 class="reflection-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							</header>

							<section class="entry-content cf">
								<?php the_content(); ?>
							</section>
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
											<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>

						<?php endif; ?>


					</main>
				</div>

				<div id="right-content">

					<main id="main-blogg" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php 
						
						
						$args = array( 'post_type' => 'blog');
						$loop = new WP_Query( $args );

						if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
							
							<div class="cf"><?php the_post_thumbnail('large'); ?></div>
							<header class="article-header blog-wrapper">
								<?php
								if (get_post_meta(get_the_ID(), '_blog_dayday', true)){ ?>
								<div class="blog-day"><span class="circle-item">DAY<br><?php echo sprintf('%02d', get_post_meta(get_the_ID(), '_blog_dayday', true)); ?></span></div><?php } ?>
								<div class="blog-thumb"><span class="circle-item" style="background-image: url('<?php echo get_wp_user_avatar_src(get_the_author_meta('ID'), 'thumbnail'); ?>')"></span></div>
								<div class="blog-author"><span><?php echo '<span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'; ?></span></div>
							</header>
							
							<section class="entry-content blog-wrapper cf">
								<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

								<p class="byline entry-meta vcard">
                                        <?php printf(
										/* the time the post was published */
										'<time class="updated entry-time" datetime="' . get_the_time('d.m.Y') . '" itemprop="datePublished">' . get_the_time('d.m.Y') . '</time>'); ?>
								</p>


								<?php the_content(); ?>
							</section>
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
											<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
									</footer>
								</article>

						<?php endif; ?>


					</main>
										
				</div> <!-- end content -->
			</div>

			

<?php get_footer(); ?>
