<?php global $wptouch2_settings; ?>
<?php global $bnc2_wptouch2_version; ?>

<div class="metabox-holder" id="wptouch2-head">
	<div class="postbox">
		<div id="wptouch2-head-colour">
			<div id="wptouch2-head-title">
				<?php WPtouch2(); ?>
				<img class="ajax-load" src="<?php echo compat_get_plugin_url('affil4you/libs/wptouch2'); ?>/images/admin-ajax-loader.gif" alt="ajax"/>
			</div>
				<div id="wptouch2-head-links">
					<ul>
						<li><?php echo sprintf(__( "%sGet WPtouch Pro%s", "affil4you_libs_wptouch2" ), '<a href="http://www.bravenewcode.com/store/plugins/wptouch2-pro/?utm_source=wptouch2&amp;utm_medium=web&amp;utm_campaign=top-' . str_replace( '.', '', $bnc2_wptouch2_version ) . '" target="_blank">','</a>'); ?> | </li>
						<li><?php echo sprintf(__( "%sJoin our FREE Affiliate Program%s", "affil4you_libs_wptouch2" ), '<a href="http://www.bravenewcode.com/affiliate-program/" target="_blank">','</a>'); ?></li> |
						<li><?php echo sprintf(__( "%sFollow Us on Twitter%s", "wordtwit" ), '<a href="http://www.twitter.com/bravenewcode" target="_blank">','</a>'); ?></li> |
						<li><?php echo sprintf(__( "%sFind Us on Facebook%s", "wordtwit" ), '<a href="http://www.facebook.com/bravenewcode" target="_blank">','</a>'); ?></li>
					</ul>
				</div>
	<div class="bnc-clearer"></div>
			</div>

		<div id="wptouch2-news-support">

			<div id="wptouch2-news-wrap">
			<h3><span class="rss-head">&nbsp;</span><?php _e( "WPtouch Wire", "affil4you_libs_wptouch2" ); ?></h3>
				<div id="wptouch2-news-content">

				</div>
			</div>

			<div id="wptouch2-support-wrap">
			<h3>&nbsp;</h3>
				<div id="wptouch2-support-content">
				<a id="find-out-more" href="http://www.bravenewcode.com/products/wptouch2-pro/?utm_source=wptouch2&amp;utm_medium=web&amp;utm_campaign=find-out-more-<?php echo str_replace( '.', '', $bnc2_wptouch2_version ); ?>" target="_blank">&nbsp;</a>
				</div>
			</div>

		</div><!-- wptouch2-news-support -->

	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- wptouch2-head -->
