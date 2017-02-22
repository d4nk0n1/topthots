<?php global $wptouch2_settings; ?>
<div class="metabox-holder">
	<div class="postbox" id="push-area">
		<h3><span class="push-options">&nbsp;</span><?php _e( "Push Notification Options", "affil4you_libs_wptouch2" ); ?></h3>

			<div class="left-content">
					<p><?php echo sprintf(__( "Here you can configure WPtouch to push selected notifications through your %sProwl%s account to your iPhone, iPod touch and Growl-enabled Mac or PC.", "affil4you_libs_wptouch2" ), '<a href="http://prowl.weks.net/" target="_blank">','</a>'); ?></p>
					<p><?php echo sprintf(__( "%sMake sure you generate a Prowl API key to use here%s otherwise no notifications will be pushed to you.", "affil4you_libs_wptouch2" ), '<strong>','</strong>'); ?></p>			
			</div><!-- left content -->

			<div class="right-content">
				<ul class="wptouch2-make-li-italic">
				<?php if ( function_exists( 'curl_init' ) ) { ?>
					<li>
						<input name="prowl-api" type="text" value="<?php echo $wptouch2_settings['prowl-api']; ?>" /><?php _e( "Prowl API Key", "affil4you_libs_wptouch2" ); ?> (<?php echo sprintf(__( "%sCreate a key now%s", "affil4you_libs_wptouch2" ), '<a href="https://prowl.weks.net/settings.php" target="_blank">','</a>'); ?> - <a href="#prowl-info" class="fancylink">?</a>)
						<div id="prowl-info" style="display:none">
							<h2><?php _e( "More Info", "affil4you_libs_wptouch2" ); ?></h2>
							<p><?php _e( "In order to enable Prowl notifications you must create a Prowl account and download + configure the Prowl application for iPhone.", "affil4you_libs_wptouch2" ); ?></p>
							<p><?php _e( "Next, visit the Prowl website and generate your API key, which WPtouch will use to send your notifications.", "affil4you_libs_wptouch2" ); ?></p>
							
							<p><?php echo sprintf(__( "%sVisit the Prowl Website%s", "affil4you_libs_wptouch2" ), '<a href="http://prowl.weks.net/settings.php" target="_blank">','</a>'); ?> | <?php echo sprintf(__( "%sVisit iTunes to Download Prowl%s", "affil4you_libs_wptouch2" ), '<a href="http://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=320876271&amp;mt=8" target="_blank">','</a>'); ?></p>
						</div>		
							<?php if ( isset( $wptouch2_settings['prowl-api'] ) && strlen( $wptouch2_settings['prowl-api'] ) ) { ?>
								<?php if ( bnc2_wptouch2_is_prowl_key_valid() ) { ?>
									<p class="valid"><?php _e( "Your Prowl API key has been verified.", "affil4you_libs_wptouch2" ); ?></p>
								<?php } else { ?>
									<p class="invalid">
										<?php _e( "Sorry, your Prowl API key is not verified.", "affil4you_libs_wptouch2" ); ?><br />
										<?php _e( "Please check your key and make sure there are no spaces or extra characters.", "affil4you_libs_wptouch2" ); ?>
									</p>
								<?php } ?>
							<?php } ?>		
					</li>
				</ul>
			
				<ul>
				<li>
					<input class="checkbox" type="checkbox" name="enable-prowl-comments-button" <?php if ( isset( $wptouch2_settings['enable-prowl-comments-button']) && $wptouch2_settings['enable-prowl-comments-button'] == 1) echo('checked'); ?> />
					<label class="label" for="enable-prowl-comments-button"><?php _e( "Notify me of new comments &amp; pingbacks/tracksbacks", "affil4you_libs_wptouch2" ); ?></label>
				</li>
				<li>
					<input class="checkbox" <?php if (!get_option('comment_registration')) : ?>disabled="true"<?php endif; ?> type="checkbox" name="enable-prowl-users-button" <?php if ( isset( $wptouch2_settings['enable-prowl-users-button']) && $wptouch2_settings['enable-prowl-users-button'] == 1) echo('checked'); ?> />
					<label class="label" for="enable-prowl-users-button"><?php _e( "Notify me of new account registrations", "affil4you_libs_wptouch2" ); ?></label>
				</li>
				<li>
					<input class="checkbox" type="checkbox" name="enable-prowl-message-button" <?php if ( isset( $wptouch2_settings['enable-prowl-message-button']) && $wptouch2_settings['enable-prowl-message-button'] == 1) echo('checked'); ?> />
					<label class="label" for="enable-prowl-message-button"><?php _e( "Allow users to send me direct messages", "affil4you_libs_wptouch2" ); ?> <a href="#dm-info" class="fancylink">?</a></label>
						<div id="dm-info" style="display:none">
						<h2><?php _e( "More Info", "affil4you_libs_wptouch2" ); ?></h2>
						<p><?php _e( "This enables a new link to a drop-down in the submenu bar for WPtouch ('Message Me').", "affil4you_libs_wptouch2" ); ?></p>
						<p><?php _e( "When opened, a form is shown for users to fill in. The name, e-mail address, and message area is shown. Thier IP will also be sent to you, in case you want to ban it in the WordPress admin.", "affil4you_libs_wptouch2" ); ?></p>
						</div>
					</li>			
					<?php } else { ?>
					<li><strong class="no-pages"><?php echo sprintf(__( "%sCURL is required%s on your webserver to use Push capabilities in WPtouch.", "affil4you_libs_wptouch2" ), '<a href="http://en.wikipedia.org/wiki/CURL" target="_blank">','</a>'); ?></strong></li>
					<?php } ?>	
				</ul>
			</div><!-- right content -->
		<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->