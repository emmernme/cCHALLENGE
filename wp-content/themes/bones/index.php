<?php get_header(); ?>
	<div id="content">	
		<div id="left-content"><?php
			ini_set('zlib.output_handler', '');

			$about = 26; // ID of about-page
			$thumb = get_post_thumbnail_id($about);
			$thumb = image_downsize($thumb, 'large')[0];
			$link = get_the_permalink($about);
			?>
			
			<div id="about" onclick="window.location.href = '<?php echo $link; ?>'"><div style="background-image:url('<?php echo $thumb;?>')"><h1><a href="<?php echo $link; ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=>$about)); ?>"><?php echo get_the_title($about); ?></a></h1>
</div></div>
			<main id="main-reflections" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog"><?php
				
				// Set up loop to get reflections.					
				$args = array( 'post_type' => 'reflection',
								'posts_per_page' => '5',
								'post__not_in' => [18,114]);
				$loop = new WP_Query( $args );
				
				// Get tweets
				$tweets = get_tweets();
				$tweet_index = 0;

				if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
				?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article"><?php if ($thumbnail = find_img_src($post)) : ?>
				
					<img src="<?php echo $thumbnail; ?>" /><?php endif; ?>
					
					<header class="article-header"><h2 class="reflection-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2></header>
					<section class="entry-content cf">
						<?php the_excerpt(); ?>
					</section>
				</article><?php
				// INSERT TWEET EVERY SECOND POST
				if (0 === ++$loop->wpse_post_counter % 2 && isset($tweets[$tweet_index])):
					$tweet = $tweets[$tweet_index];
				?>
				
				<article id="tweet-<?php echo $tweet->id; ?>" class="tweet">
					<div><span class="twitter-icon"></span>
						<p class="twitter-name"><?php echo $tweet->user->name; ?></p>
						<p class="twitter-handle"><a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>">@<?php echo $tweet->user->screen_name; ?></a></p>
						<p class="twitter-tweet"><?php echo linkify_tweet($tweet->text); ?></p>
					</div>
				</article><?php
					$tweet_index++; endif;
					// End the blog loop
					endwhile;
					endif;
					?>
			
			</main>
		</div>
		<div id="right-content">
			<main id="main-blogg" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog"><?php 
				// Set up filter to get five most recent posts from unique users
				add_filter( 'posts_where', 'unique_user_posts' );
				
				$args = array( 'post_type' => 'blog',
								'posts_per_page' => 4);
				$loop = new WP_Query( $args );

				if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article"><?php
						// Get the link for the authors archive 
						$author_archive = get_author_posts_url(get_the_author_meta('ID'));
						
						// Display thumbnail if there is one
						if ($thumbnail = find_img_src($post)) : ?>
						
					<div class="cf blog-image"><a href="<?php echo $author_archive; ?>" rel="bookmark" title="<?php the_author(); ?>"><img src="<?php echo $thumbnail; ?>" /></a></div><?php endif; ?>
					
					<header class="article-header blog-wrapper"><?php
						// Get the meta value for day number
						if ($blog_day = get_post_meta(get_the_ID(), '_blog_dayday', true)) : ?>
						
						<div class="blog-day"><span class="circle-item header-span"><span>DAY</span><br><span class="bolder"><?php echo sprintf('%02d', $blog_day); ?></span></span></div><?php endif; ?>
						
						<div class="blog-thumb"><span class="circle-item header-span" style="background-image: url('<?php echo get_wp_user_avatar_src(get_the_author_meta('ID'), 'thumbnail'); ?>')"></span></div>
						<div class="blog-author"><a href="<?php echo $author_archive; ?>" rel="bookmark" title="<?php the_author(); ?>"><span class="header-span"><span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person"><?php the_author(); ?></span></span></a></div>
					</header>
					<section class="entry-content blog-wrapper cf">
						<h2 class="entry-title"><a href="<?php echo $author_archive; ?>" rel="bookmark" title="<?php the_author(); ?>"><?php the_title(); ?></a></h1>
						<p class="byline entry-meta vcard"><?php
							printf('<time class="updated entry-time" datetime="' . get_the_time('d.m.Y') . '" itemprop="datePublished">' . get_the_time('d.m.Y') . '</time>');
						?></p>
						<?php the_excerpt(); ?>
					</section>
				</article><?php
					// End the blog loop
					endwhile; 
					// Remove the unique author-filter
					remove_filter('posts_where', 'unique_user_posts');
					
					endif;
				?>
				
				<button type="button" id="see-all" onclick="window.location.href = '<?php echo get_the_permalink(49); ?>'">See all participants</button>
			</main>
		</div> <!-- end content -->
	</div><?php 
		get_footer();
?>