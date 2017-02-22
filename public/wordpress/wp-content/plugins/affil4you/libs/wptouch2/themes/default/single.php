<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<?php $wptouch2_settings = bnc2_wptouch2_get_settings(); ?>

<div class="content single" id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">
			    <a class="sh2" href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( "Permanent Link to ", "affil4you_libs_wptouch2" ); ?><?php if (function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php the_title(); ?></a>
			        <div class="single-post-meta-top"><?php echo get_the_time( __( 'M jS, Y @ h:i a', 'affil4you_libs_wptouch2' 
) ) ?> &rsaquo; <?php the_author() ?><br />

		<!-- Let's check for DISQUS... we need to skip to a different div if it's installed and active -->		
		<?php if ( 'open' == $post->comment_status && bnc2_can_show_comments() ) : ?>
			<?php if (function_exists('dsq_comments_template')) { ?>
		 		<a href="#dsq-add-new-comment">&darr; <?php _e( "Skip to comments", "affil4you_libs_wptouch2" ); ?></a>
			<?php } elseif (function_exists('id_comments_template')) { ?>
				<a href="#idc-container-parent">&darr; <?php _e( "Skip to comments", "affil4you_libs_wptouch2" ); ?></a>
			<?php } elseif (isset($post->comment_count) && $post->comment_count == 0) { ?>
				<a href="#respond">&darr; <?php _e( "Leave a comment", "affil4you_libs_wptouch2" ); ?></a>
			<?php } elseif (isset($post->comment_count) && $post->comment_count > 0) { ?>
				<a href="#com-head">&darr; <?php _e( "Skip to comments", "affil4you_libs_wptouch2" ); ?></a>
			<?php } ?>
		<?php endif; ?>
		</div>
	</div>

		<div class="clearer"></div>
			<?php wptouch2_include_ads(); ?>

        	<div class="post" id="post-<?php the_ID(); ?>">
         	<div id="singlentry" class="<?php echo $wptouch2_settings['style-text-justify']; ?>">
            	<?php the_content(); ?>				
			</div>  
			
<!-- Categories and Tags post footer -->        

			<div class="single-post-meta-bottom">
					<?php wp_link_pages( 'before=<div class="post-page-nav">' . __( "Article Pages", "wptouch2-pro" ) . ':&after=</div>&next_or_number=number&pagelink=page %&previouspagelink=&raquo;&nextpagelink=&laquo;' ); ?>          
			    <?php _e( "Categories", "affil4you_libs_wptouch2" ); ?>: <?php if (the_category(', ')) the_category(); ?>
			    <?php if (function_exists('get_the_tags')) the_tags('<br />' . __( 'Tags', 'affil4you_libs_wptouch2' ) . ': ', ', ', ''); ?>  
		    </div>   

		<ul id="post-options">
		<?php $prevPost = get_previous_post(); if ($prevPost) { ?>
			<li><a href="<?php $prevPost = get_previous_post(false); $prevURL = get_permalink($prevPost->ID); echo $prevURL; ?>" id="oprev"></a></li>
		<?php } ?>
		<li><a href="mailto:?subject=<?php
bloginfo('name'); ?>- <?php the_title_attribute();?>&body=<?php _e( "Check out this post:", "affil4you_libs_wptouch2" ); ?>%20<?php the_permalink() ?>" onclick="return confirm('<?php _e( "Mail a link to this post?", "affil4you_libs_wptouch2" ); ?>');" id="omail"></a></li>
		<?php wptouch2_twitter_link(); ?>
		<?php wptouch2_facebook_link(); ?>
		<li><a href="javascript:return false;" id="obook"></a></li>
		<?php $nextPost = get_next_post(); if ($nextPost) { ?>
			<li><a href="<?php $nextPost = get_next_post(false); $nextURL = get_permalink($nextPost->ID); echo $nextURL; ?>" id="onext"></a></li>
		<?php } ?>
		</ul>
    </div>

  	<div id="bookmark-box" style="display:none">
		<ul>
			<li><a  href="http://del.icio.us/post?url=<?php echo get_permalink()
?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'affil4you/libs/wptouch2' ); ?>/themes/core/core-images/bookmarks/delicious.jpg" alt="" /> <?php _e( "Del.icio.us", "affil4you_libs_wptouch2" ); ?></a></li>
			<li><a href="http://digg.com/submit?phase=2&url=<?php echo get_permalink()
?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'affil4you/libs/wptouch2' ); ?>/themes/core/core-images/bookmarks/digg.jpg" alt="" /> <?php _e( "Digg", "affil4you_libs_wptouch2" ); ?></a></li>
			<li><a href="http://technorati.com/faves?add=<?php the_permalink() ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'affil4you/libs/wptouch2' ); ?>/themes/core/core-images/bookmarks/technorati.jpg" alt="" /> <?php _e( "Technorati", "affil4you_libs_wptouch2" ); ?></a></li>
			<li><a href="http://ma.gnolia.com/bookmarklet/add?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'affil4you/libs/wptouch2' ); ?>/themes/core/core-images/bookmarks/magnolia.jpg" alt="" /> <?php _e( "Magnolia", "affil4you_libs_wptouch2" ); ?></a></li>
			<li><a href="http://www.newsvine.com/_wine/save?popoff=0&u=<?php echo get_permalink() ?>&h=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'affil4you/libs/wptouch2' ); ?>/themes/core/core-images/bookmarks/newsvine.jpg" target="_blank"> <?php _e( "Newsvine", "affil4you_libs_wptouch2" ); ?></a></li>
			<li class="noborder"><a href="http://reddit.com/submit?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'affil4you/libs/wptouch2' ); ?>/themes/core/core-images/bookmarks/reddit.jpg" alt="" /> <?php _e( "Reddit", "affil4you_libs_wptouch2" ); ?></a></li>
		</ul>
	</div>

<!-- Let's rock the comments -->
<?php if ( bnc2_can_show_comments() ) : ?>
	<?php comments_template(); ?>
<script type="text/javascript">
jQuery(document).ready( function() {
// Ajaxify '#commentform'
var formoptions = { 
	beforeSubmit: function() {$wpt("#loading").fadeIn(400);},
	success:  function() {
		$wpt("#commentform").hide();
		$wpt("#loading").fadeOut(400);
		$wpt("#refresher").fadeIn(400);
		}, // end success 
	error:  function() {
		$wpt('#errors').show();
		$wpt("#loading").fadeOut(400);
		} //end error
	} 	//end options
$wpt('#commentform').ajaxForm(formoptions);
}); //End onReady
</script>
<?php endif; ?>
	<?php endwhile; else : ?>

<!-- Dynamic test for what page this is. A little redundant, but so what? -->

	<div class="result-text-footer">
		<?php wptouch2_core_else_text(); ?>
	</div>

	<?php endif; ?>
</div>
	
	<!-- Do the footer things -->
	
<?php global $is_ajax; if (!$is_ajax) get_footer();