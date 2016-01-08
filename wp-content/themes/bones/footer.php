		<?php if (is_home() || is_page(49)){ ?>
		</div> <!-- end left (from header) -->
		<?php } ?>
			<div class="right" id="right">
				<?php // get_sidebar(); ?>
				<?php if (is_home() || is_page(49)){ ?>
				<div id="newsletter">
					<div id="newsletter-greenbox"><p class="normal">REGISTER FOR THE NEXT</p><p class="bigger">cCHALLENGE</p></div>
					<div id="greenbox"></div>
					<div id="newsletter-register">
						<p>Do you want to keep updated?</p>
						<p>Register your email address below!</p>
						<p>Insert box here</p>
					</div>
				</div>
				<?php if (is_home()) { ?>
				<?php
				$collab = 41; // ID of collab-page
				$thumb_collab = get_post_thumbnail_id($collab);
				$thumb_collab = wp_get_attachment_url($thumb_collab);

				$partner = 43; // ID of partner-page
				$thumb_partner = get_post_thumbnail_id($partner);
				$thumb_partner = wp_get_attachment_url($thumb_partner);
				?>
				<div id="collaborative-change" class="right-box"><div style="background-image:url('<?php echo $thumb_collab;?>')"><h2><a href="<?php get_the_permalink($collab) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=>$collab)); ?>"><?php echo get_the_title($collab); ?></a></h2></div></div>
				<div id="partner" class="right-box"><div style="background-image:url('<?php echo $thumb_partner;?>')"><h2><a href="<?php get_the_permalink($partner) ?>" rel="bookmark" title="<?php the_title_attribute(array('post'=>$partner)); ?>"><?php echo get_the_title($partner); ?></a></h2></div></div>
				<div id="participants">
					<h2>Participants</h2>
					<?php wp_list_authors(['show_fullname' => true, 'exclude' => '', 'hide_empty' => false]); ?>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<?php
				if (is_page(49)){
					echo '<div id="author-clear" class="cf"></div>';
					echo '<div id="author-grid" class="wrap">';
					$users = get_users(['role' => 'author']);
					// Array of WP_User objects.
					//foreach ( $users as $user ) {
					// Looping instead because we lack users. Remember to remove loop before release!
					$user = $users[0];
					for($i = 1; $i <= 25; $i++){
						echo '<div class="author-box">';
						echo '<div class="author-image" style="background-image:url('. get_wp_user_avatar_src($user->ID, 'medium') .')"></div>';
						echo '<h3>'. esc_html( $user->user_nicename ) . '</h3>';
						echo '<p>My cCHANGE challenge:<br/>';
						the_author_meta('cCHALLENGE', $user->ID);
						echo '</p></div>';
					}
					echo '<div id="gutter"></div>';
					echo '</div>';
				}
			?>
			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
				<?php if (is_home()){ ?>
				<div id="instagram">
					<div id="instabox"><div><div><p class="bigger">Instagramfeed</p><a class="normal" href="http://instagr.am/cchallenge">@cchallenge</a></div></div></div>
					<!--<div id="container"><div id="greenbox"></div></div>-->
					<div id="instaphotos"><?php echo do_shortcode('[instagram-feed]'); ?></div>
				</div>
				<?php } ?>
				
				<div id="inner-footer" class="wrap cf">
					<p id="p-email">contact@cchallenge.no</p>
					<p id="p-facebook" class="float-right">Facebook</p>
					<p id="p-twitter" class="float-right">Twitter</p>
					<p id="p-instagram" class="float-right">Instagram</p>
				</div>

			</footer>

		</div>
		</div>
		<?php // end main-wrap div ?>
		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>
	</body>

</html> <!-- end of site. what a ride! -->
