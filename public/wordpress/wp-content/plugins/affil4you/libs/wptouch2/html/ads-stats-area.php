<?php global $wptouch2_settings; ?>

<div class="metabox-holder">
	<div class="postbox new-styles" id="advertising-options">
		<h3><span class="adsense-options">&nbsp;</span><?php _e( "Advertising, Stats &amp; Custom Code", "affil4you_libs_wptouch2" ); ?></h3>
		<div id="advertising-service">
			<div class="left-content">
				<h4><?php _e( 'Advertising Service', 'affil4you_libs_wptouch2' ); ?></h4>
				<p><?php _e( 'Choose which advertising service you would like to use within WPtouch.', 'affil4you_libs_wptouch2' ); ?></p>
			</div>
			
			<div class="right-content">
				<ul class="wptouch2-make-li-italic">
					<li>
						<select name="ad_service" id="ad_service">
							<option value="none"<?php if ( $wptouch2_settings['ad_service'] == 'none') echo " selected"; ?>><?php _e( "None", "affil4you_libs_wptouch2" ); ?></option>		
							<option value="adsense"<?php if ( $wptouch2_settings['ad_service'] == 'adsense') echo " selected"; ?>><?php _e( "Google Adsense", "affil4you_libs_wptouch2" ); ?></option>
		
						</select>
						<?php _e( "Advertising Service", "affil4you_libs_wptouch2" ); ?>
					</li>
				</ul>	
			</div>			
			<div class="bnc-clearer"></div>
		</div>		
		
		<div id="google-adsense">
			<div class="left-content">
				<h4><?php _e( "Google Adsense", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "Enter your Google AdSense ID if you'd like use it to add support for mobile advertising in WPtouch posts.", "affil4you_libs_wptouch2" ); ?></p>
				<p><?php _e( "Make sure to include the 'pub-' part of your ID string.", "affil4you_libs_wptouch2" ); ?></p>
			</div>
			
			<div class="right-content">
				<ul class="wptouch2-make-li-italic">
					<li><input name="adsense-id" type="text" value="<?php echo $wptouch2_settings['adsense-id']; ?>" /><?php _e( "Google AdSense ID", "affil4you_libs_wptouch2" ); ?></li>
					<li><input name="adsense-channel" type="text" value="<?php echo $wptouch2_settings['adsense-channel']; ?>" /><?php _e( "Google AdSense Channel", "affil4you_libs_wptouch2" ); ?></li>
				</ul>
			</div>			
			<div class="bnc-clearer"></div>
		</div>	
		
		<div id="main-stats-area">
			<div class="left-content">
		    	<h4><?php _e( "Stats &amp; Custom Code", "affil4you_libs_wptouch2" ); ?></h4>
		 		<p><?php _e( "If you'd like to capture traffic statistics ", "affil4you_libs_wptouch2" ); ?><br /><?php _e( "(Google Analytics, MINT, etc.)", "affil4you_libs_wptouch2" ); ?></p>
		 		<p><?php _e( "Enter the code snippet(s) for your statistics tracking.", "affil4you_libs_wptouch2" ); ?> <?php _e( "You can also enter custom CSS &amp; other HTML code.", "affil4you_libs_wptouch2" ); ?> <a href="#css-info" class="fancylink">?</a></p>
		 		<div id="css-info" style="display:none">
					<h2><?php _e( "More Info", "affil4you_libs_wptouch2" ); ?></h2>
					<p><?php _e( "You may enter a custom css file link easily. Simply add the full link to the css file like this:", "affil4you_libs_wptouch2" ); ?></p>
					<p><?php _e( "<code>&lt;style type=&quot;text/css&quot;&gt;#mydiv { color: red; }&lt;/style&gt;</code>", "affil4you_libs_wptouch2" ); ?></p>			
				</div>	
			</div>
			
			<div class="right-content">
				<?php if ( is_super_admin() ) { ?>
					<textarea id="wptouch2-stats" name="statistics"><?php echo stripslashes($wptouch2_settings['statistics']); ?></textarea>
				<?php } else { ?>
					<em><?php _e( "(Requires Super Admin priviledges)", "affil4you_libs_wptouch2" ); ?></em>
				<?php } ?>
			</div>
			<div class="bnc-clearer"></div>
		</div>		
	</div><!-- postbox -->
</div><!-- metabox -->