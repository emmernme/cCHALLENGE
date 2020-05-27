<?php if (is_home() || is_page(49) || is_404()){ ?>

</div> <!-- end left (from header) -->
<?php } ?>
	<div class="right" id="right">
		<?php // get_sidebar(); ?>
		<?php if (is_home() || is_page(49) || is_404()){ ?>
		<div id="newsletter"> 
			<div id="newsletter-greenbox"><p class="normal">REGISTER FOR THE NEXT</p><p class="bigger">cCHALLENGE</p></div>
			<div id="greenbox"></div>
			<div id="newsletter-register">
				<p>Do you want to keep updated?</p>
				<p>Register your email address below!</p>
				<form action="http://itch-oslo.createsend.com/t/d/s/ijkduh/" method="post" id="subForm">
				    <input id="fieldEmail" class="newsletter-email" name="cm-ijkduh-ijkduh" type="email" placeholder="Your email" required />
				    <input class="newsletter-submit" type="submit" value="SEND" />
				</form>
				</div>
		</div>
		<?php if (is_home()) { ?>
		<?php
			$collab = 18; // ID of collab-page
			$thumb_collab = get_post_thumbnail_id($collab);
			$thumb_collab = image_downsize($thumb_collab, 'large')[0];
			$collab_url = get_the_permalink($collab);
			$collab_title = get_post_meta($collab, '_front_titletitle', true);
			if (empty($collab_title)){
				$collab_title = get_the_title($collab);
			}

			$partner = 114; // ID of partner-page 
			$thumb_partner = get_post_thumbnail_id($partner);
			$thumb_partner = image_downsize($thumb_partner, 'large')[0];
			$partner_url = get_the_permalink($partner);
			$partner_title = get_post_meta($partner, '_front_titletitle', true);
			if (empty($partner_title)){
				$partner_title = get_the_title($partner);
			}
		?>
		<div id="collaborative-change" class="right-box" onclick="window.location.href = '<?php echo $collab_url; ?>'">
			<a class="linkbox" href="<?php echo $collab_url; ?>" rel="bookmark" title="<?php echo $collab_title; ?>"><div style="background-image:url('<?php echo $thumb_collab;?>')"><h2><?php echo $collab_title; ?></h2></div></a>
		</div><div id="partner" class="right-box" onclick="window.location.href = '<?php echo $partner_url; ?>'">
			<a class="linkbox" href="<?php echo $partner_url; ?>" rel="bookmark" title="<?php echo $partner_title; ?>"><div style="background-image:url('<?php echo $thumb_partner;?>')"><h2><?php echo $partner_title; ?></h2></div></a>
		</div>
		<div id="participants">
			<h2>Participants</h2>
			<?php 
				$authors = get_users(['role' => 'author', 'fields' => ['ID','display_name']]);
				foreach ($authors as $author){
					echo '<li><a href="'. get_author_posts_url($author->ID) .'" title="'. $author->display_name .'">'. $author->display_name .'</a></li>';
				}
				?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php
		if (is_page(49)){
			echo '<div id="author-clear" class="cf"></div>';
			echo '<div id="author-grid" class="wrap">';
			$users = get_users(['role' => 'author', 'fields' => ['ID','display_name']]);
			// Array of WP_User objects.
			foreach ( $users as $user ) {
				echo '<div class="author-box"><a href="'. get_author_posts_url($user->ID). '">';
				echo '<div class="author-image" style="background-image:url('. get_wp_user_avatar_src($user->ID, 'large') .')"></div>';
				echo '<h3>'. esc_html( $user->display_name ) . '</h3></a>';
				echo '<p>My cCHALLENGE:<br/>';
				the_author_meta('cCHALLENGE', $user->ID);
				echo '</p></div>';
				echo '<div class="gutter"></div>';
			}
			echo '</div>';
		}
	?>
	<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
		<?php if (is_home()){ ?>
		<div id="instagram">
			<div id="instabox"><div id="sizer"><div id="outer"><div id="middle"><div id="inner"><p class="bigger">Instagramfeed</p><a class="normal" href="http://instagr.am/cchallenge_global">@cchallenge_global</a></div></div></div></div>
			</div><div id="greenbox"></div><div id="instaphotos"><?php echo do_shortcode('[instagram-feed]'); ?></div>
		</div>
		<?php } ?>
		
		<div id="inner-footer" class="wrap cf">
			<p id="p-email"><a href="mailto:post@cchallenge.no" alt="contact email"><span>post@cchallenge.no</span></a></p>
			<p id="p-facebook" class="float-right"><a href="http://facebook.com/cchange.no" alt="Facebook"><span class="fb icon"></span><span class="social">Facebook</span></a></p>
			<p id="p-twitter" class="float-right"><a href="http://twitter.com/cCHANGE_Climate" alt="Twitter"><span class="tw icon"></span><span class="social">Twitter</span></a></p>
			<p id="p-instagram" class="float-right"><a href="http://instagr.am/cchallenge_global" alt="Instagram"><span class="in icon"></span><span class="social">Instagram</span></a></p>
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
