<?php global $wptouch2_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><span class="global-settings">&nbsp;</span><?php _e( "General Settings", "affil4you_libs_wptouch2" ); ?></h3>

			<div class="left-content">
				<h4><?php _e( "Regionalization Settings", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "Select the language for WPtouch.  Custom .mo files should be placed in wp-content/wptouch2/lang.", "affil4you_libs_wptouch2" ); ?></p>
				<br /><br />

				<h4><?php _e( "Home Page Re-Direction", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php echo sprintf( __( "WPtouch by default follows your %sWordPress &raquo; Reading Options%s.", "affil4you_libs_wptouch2"), '<a href="options-reading.php">', '</a>' ); ?></p>

				<br /><br />

				<h4><?php _e( "Site Title", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "You can change your site title (if needed) in WPtouch.", "affil4you_libs_wptouch2" ); ?></p>

				<br /><br />

				<h4><?php _e( "Excluded Categories", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "Categories by ID you want excluded everywhere in WPtouch.", "affil4you_libs_wptouch2" ); ?></p>

				<h4><?php _e( "Excluded Tags", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "Tags by ID you want excluded everywhere in WPtouch.", "affil4you_libs_wptouch2" ); ?></p>

				<br /><br />

				<h4><?php _e( "Text Justification Options", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "Set the alignment for text.", "affil4you_libs_wptouch2" ); ?></p>

				<br /><br />

				<h4><?php _e( "Post Listings Options", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "Choose between calendar Icons, post thumbnails (WP 2.9) or none for your post listings.", "affil4you_libs_wptouch2" ); ?></p>
				<p><?php _e( "Select which meta items are shown below titles on main, search, &amp; archives pages.", "affil4you_libs_wptouch2" ); ?></p>

				<br /><br /><br /><br /><br /><br /><br /><br /><br />

				<h4><?php _e( "Footer Message", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "Customize the default footer message shown in WPtouch here.", "affil4you_libs_wptouch2" ); ?></p>
			</div>

			<div class="right-content">
				<p><label for="home-page"><strong><?php _e( "WPtouch Language", "affil4you_libs_wptouch2" ); ?></strong></label></p>
				<ul class="wptouch2-make-li-italic">
					<li>
						<select name="wptouch2-language">
							<option value="auto"<?php if ( $wptouch2_settings['wptouch2-language'] == "auto" ) echo " selected"; ?>><?php _e( "Automatically detected", "affil4you_libs_wptouch2" ); ?></option>
							<option value="fr_FR"<?php if ( $wptouch2_settings['wptouch2-language'] == "fr_FR" ) echo " selected"; ?>>Français</option>
							<option value="es_ES"<?php if ( $wptouch2_settings['wptouch2-language'] == "es_ES" ) echo " selected"; ?>>Español</option>
							<option value="eu_EU"<?php if ( $wptouch2_settings['wptouch2-language'] == "eu_EU" ) echo " selected"; ?>>Basque</option>
							<option value="de_DE"<?php if ( $wptouch2_settings['wptouch2-language'] == "de_DE" ) echo " selected"; ?>>Deutsch</option>
							<option value="ja_JP"<?php if ( $wptouch2_settings['wptouch2-language'] == "ja_JP" ) echo " selected"; ?>>Japanese</option>
							<option value="tr_TR"<?php if ( $wptouch2_settings['wptouch2-language'] == "tr_TR" ) echo " selected"; ?>>Türkçe</option>
							<option value="it_IT"<?php if ( $wptouch2_settings['wptouch2-language'] == "it_IT" ) echo " selected"; ?>>Italiano</option>

							<?php $custom_lang_files = bnc2_get_wptouch2_custom_lang_files(); ?>
							<?php if ( count( $custom_lang_files ) ) { ?>
								<?php foreach( $custom_lang_files as $lang_file ) { ?>
									<option value="<?php echo $lang_file->prefix; ?>"<?php if ( $wptouch2_settings['wptouch2-language'] == $lang_file->prefix ) echo " selected"; ?>><?php echo $lang_file->name; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</li>
				</ul>
				<br /><br />

				<p><label for="home-page"><strong><?php _e( "WPtouch Home Page", "affil4you_libs_wptouch2" ); ?></strong></label></p>
				<?php $pages = bnc2_get_pages_for_icons(); ?>
				<?php if ( count( $pages ) ) { ?>
					<?php wp_dropdown_pages( 'show_option_none=WordPress Settings&name=home-page&selected=' . bnc2_get_selected_home_page()); ?>
				<?php } else {?>
					<strong class="no-pages"><?php _e( "You have no pages yet. Create some first!", "affil4you_libs_wptouch2" ); ?></strong>
				<?php } ?>

				<br /><br /><br />

				<ul class="wptouch2-make-li-italic">
					<li><input type="text" class="no-right-margin" name="header-title" value="<?php $str = $wptouch2_settings['header-title']; echo stripslashes($str); ?>" /><?php _e( "Site title text", "affil4you_libs_wptouch2" ); ?></li>
				</ul>

				<br /><br />

				<ul class="wptouch2-make-li-italic">
				<li><input name="excluded-cat-ids" class="no-right-margin" type="text" value="<?php $str = $wptouch2_settings['excluded-cat-ids']; echo stripslashes($str); ?>" /><?php _e( "Comma list of Category IDs, eg: 1,2,3", "affil4you_libs_wptouch2" ); ?></li>
				<li><input name="excluded-tag-ids" class="no-right-margin" type="text" value="<?php $str = $wptouch2_settings['excluded-tag-ids']; echo stripslashes($str); ?>" /><?php _e( "Comma list of Tag IDs, eg: 1,2,3", "affil4you_libs_wptouch2" ); ?></li>
				</ul>

				<br /><br />

				<ul class="wptouch2-make-li-italic">

					<li><select name="style-text-justify">
							<option <?php if ($wptouch2_settings['style-text-justify'] == "left-justified") echo " selected"; ?> value="left-justified"><?php _e( "Left", "affil4you_libs_wptouch2" ); ?></option>
							<option <?php if ($wptouch2_settings['style-text-justify'] == "full-justified") echo " selected"; ?> value="full-justified"><?php _e( "Full", "affil4you_libs_wptouch2" ); ?></option>
						</select>
						<?php _e( "Font justification", "affil4you_libs_wptouch2" ); ?>
					</li>
				</ul>
				<br />
				<ul>
					<li>
						<ul class="wptouch2-make-li-italic">
							<li><select name="post-cal-thumb">
									<option <?php if ($wptouch2_settings['post-cal-thumb'] == "calendar-icons") echo " selected"; ?> value="calendar-icons"><?php _e( "Calendar Icons", "affil4you_libs_wptouch2" ); ?></option>
									<option <?php $version = bnc2_get_wp_version(); if ($version <= 2.89) : ?>disabled="true"<?php endif; ?> <?php if ($wptouch2_settings['post-cal-thumb'] == "post-thumbnails") echo " selected"; ?> value="post-thumbnails"><?php _e( "Post Thumbnails / Featured Images", "affil4you_libs_wptouch2" ); ?></option>
									<option <?php $version = bnc2_get_wp_version(); if ($version <= 2.89) : ?>disabled="true"<?php endif; ?> <?php if ($wptouch2_settings['post-cal-thumb'] == "post-thumbnails-random") echo " selected"; ?> value="post-thumbnails-random"><?php _e( "Post Thumbnails / Featured Images (Random)", "affil4you_libs_wptouch2" ); ?></option>
									<option <?php if ($wptouch2_settings['post-cal-thumb'] == "nothing-shown") echo " selected"; ?> value="nothing-shown"><?php _e( "No Icon or Thumbnail", "affil4you_libs_wptouch2" ); ?></option>
								</select>
								<?php _e( "Post Listings Display", "affil4you_libs_wptouch2" ); ?> <small>(<?php _e( "Thumbnails Requires WordPress 2.9+", "affil4you_libs_wptouch2" ); ?>)</small> <a href="#thumbs-info" class="fancylink">?</a>
				<div id="thumbs-info" style="display:none">
					<h2><?php _e( "More Info", "affil4you_libs_wptouch2" ); ?></h2>
					<p><?php _e( "This will change the display of blog and post listings between Calendar Icons view and Post Thumbnails view.", "affil4you_libs_wptouch2" ); ?></p>
					<p><?php _e( "The <em>Post Thumbnails w/ Random</em> option will fill missing post thumbnails with random abstract images. (WP 2.9+)", "affil4you_libs_wptouch2" ); ?></p>
				</div>
							</li>
						</ul>
					</li>
					<li>
						<input type="checkbox" class="checkbox" name="enable-truncated-titles" <?php if (isset($wptouch2_settings['enable-truncated-titles']) && $wptouch2_settings['enable-truncated-titles'] == 1) echo('checked'); ?> />
						<label for="enable-truncated-titles"><?php _e( "Enable Truncated Titles", "affil4you_libs_wptouch2" ); ?> <small>(<?php _e( "Will use ellipses when titles are too long instead of wrapping them", "affil4you_libs_wptouch2" ); ?>)</small></label>
					</li>
					<li>
						<input type="checkbox" class="checkbox" name="enable-main-name" <?php if (isset($wptouch2_settings['enable-main-name']) && $wptouch2_settings['enable-main-name'] == 1) echo('checked'); ?> />
						<label for="enable-authorname"> <?php _e( "Show Author's Name", "affil4you_libs_wptouch2" ); ?></label>
					</li>
					<li>
						<input type="checkbox" class="checkbox" name="enable-main-categories" <?php if (isset($wptouch2_settings['enable-main-categories']) && $wptouch2_settings['enable-main-categories'] == 1) echo('checked'); ?> />
						<label for="enable-categories"> <?php _e( "Show Categories", "affil4you_libs_wptouch2" ); ?></label>
					</li>
					<li>
						<input type="checkbox" class="checkbox" name="enable-main-tags" <?php if (isset($wptouch2_settings['enable-main-tags']) && $wptouch2_settings['enable-main-tags'] == 1) echo('checked'); ?> />
						<label for="enable-tags"> <?php _e( "Show Tags", "affil4you_libs_wptouch2" ); ?></label>
					</li>
					<li>
						<input type="checkbox" class="checkbox" name="enable-post-excerpts" <?php if (isset($wptouch2_settings['enable-post-excerpts']) && $wptouch2_settings['enable-post-excerpts'] == 1) echo('checked'); ?> />
						<label for="enable-excerpts"><?php _e( "Hide Excerpts", "affil4you_libs_wptouch2" ); ?></label>
					</li>
				</ul>
				<br /><br />
				<ul class="wptouch2-make-li-italic">
					<li><input type="text" class="no-right-margin footer-msg" name="custom-footer-msg" value="<?php $str = $wptouch2_settings['custom-footer-msg']; echo stripslashes($str); ?>" /><?php _e( "Footer message", "affil4you_libs_wptouch2" ); ?></li>
				</ul>
			</div>

	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->
