<?php global $wptouch2_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><span class="page-options">&nbsp;</span><?php _e( "Logo Icon // Menu Items &amp; Pages Icons", "affil4you_libs_wptouch2" ); ?></h3>

			<div class="left-content">
				<h4><?php _e( "Logo / Home Screen Icon <br />&amp; Default Menu Items", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php echo sprintf( __( "If you do not want your logo to have the glossy effect added to it, make sure you select %sEnable Flat Bookmark Icon%s", "affil4you_libs_wptouch2"), "<strong>", "</strong>" ); ?></p>
				<p><?php _e( "Choose the logo displayed in the header (also your bookmark icon), and the pages you want included in the WPtouch drop-down menu.", "affil4you_libs_wptouch2" ); ?>
				<strong><?php _e( "Remember, only those checked will be shown.", "affil4you_libs_wptouch2" ); ?></strong></p>
				<p><?php _e( "Enable/Disable default items in the WPtouch site menu.", "affil4you_libs_wptouch2"); ?></p>
<br /><br />
				<h4><?php _e( "Pages + Icons", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "Next, select the icons from the lists that you want to pair with each page menu item.", "affil4you_libs_wptouch2" ); ?></p>
				<p><?php _e( "You can also decide if pages are listed by the page order (ID) in WordPress, or by name (default).", "affil4you_libs_wptouch2" ); ?></p>
			</div><!-- left-content -->

	<div class="right-content wptouch2-pages">
		<ul>
			<li><select name="enable_main_title">
					<?php bnc2_get_icon_drop_down_list( $wptouch2_settings['main_title']); ?>
				</select>
				<?php _e( "Logo &amp; Home Screen Bookmark Icon", "affil4you_libs_wptouch2" ); ?>
				<br />
			</li>
		</ul>
		<ul>
			<li><input type="checkbox" class="checkbox" name="enable-flat-icon" <?php if (isset($wptouch2_settings['enable-flat-icon']) && $wptouch2_settings['enable-flat-icon'] == 1) echo('checked'); ?> /><label for="enable-flat-icon"><?php _e( "Enable Flat Bookmark Icon", "affil4you_libs_wptouch2" ); ?> <a href="#logo-info" class="fancylink">?</a></label>
			<div id="logo-info" style="display:none">
				<h2><?php _e( "More Info", "affil4you_libs_wptouch2" ); ?></h2>
				<p><?php _e( "The default applies for iPhone/iPod touch applies a glossy effect to the home-screen bookmark/logo icon you select.", "affil4you_libs_wptouch2" ); ?></p>
				<p><?php _e( "When checked your icon will not have the glossy effect automatically applied to it.", "affil4you_libs_wptouch2" ); ?></p>
			</div>
			</li>
			<li><input type="checkbox" class="checkbox" name="enable-main-home" <?php if (isset($wptouch2_settings['enable-main-home']) && $wptouch2_settings['enable-main-home'] == 1) echo('checked'); ?> /><label for="enable-main-home"><?php _e( "Enable Home Menu Item", "affil4you_libs_wptouch2" ); ?></label></li>
			<li><input type="checkbox" class="checkbox" name="enable-main-rss" <?php if (isset($wptouch2_settings['enable-main-rss']) && $wptouch2_settings['enable-main-rss'] == 1) echo('checked'); ?> /><label for="enable-main-rss"><?php _e( "Enable RSS Menu Item", "affil4you_libs_wptouch2" ); ?></label></li>
			<li><input type="checkbox" class="checkbox" name="enable-main-email" <?php if (isset($wptouch2_settings['enable-main-email']) && $wptouch2_settings['enable-main-email'] == 1) echo('checked'); ?> /><label for="enable-main-email"><?php _e( "Enable Email Menu Item", "affil4you_libs_wptouch2" ); ?> <small>(<?php _e( "Uses default WordPress admin e-mail", "affil4you_libs_wptouch2" ); ?>)</small></label><br /></li>
			<?php if ( false && function_exists( 'twentyeleven_setup' ) || function_exists( 'twentyten_setup' ) ) { ?>
				<li><input type="checkbox" class="checkbox" name="enable-twenty-eleven-footer" <?php if ( isset( $wptouch2_settings['enable-twenty-eleven-footer']) && $wptouch2_settings['enable-twenty-eleven-footer'] == 1) echo( 'checked' ); ?> /><label for="enable-twenty-eleven-footer"><?php _e( "Show powered by WPtouch in footer", "affil4you_libs_wptouch2" ); ?> <small>(<?php _e( "Adds WPtouch to the 'Powered by WordPress' area in footer of desktop theme", "affil4you_libs_wptouch2" ); ?>)</small></label>
			<?php } ?>
			<li><input type="checkbox" class="checkbox" name="show_powered_by" <?php if ( isset($wptouch2_settings['show_powered_by']) && $wptouch2_settings['show_powered_by'] == 1) echo('checked'); ?> /><label for="show_powered_by"><?php _e( "Enable 'Powered By WPtouch' in mobile theme footer", "affil4you_libs_wptouch2" ); ?></label><br /></li>

			<br /><br /><br />

		<?php if ( count( $pages ) ) { ?>
			<li><br /><br />
			<select name="sort-order">
					<option value="name"<?php if ( $wptouch2_settings['sort-order'] == 'name') echo " selected"; ?>><?php _e( "By Name", "affil4you_libs_wptouch2" ); ?></option>
					<option value="page"<?php if ( $wptouch2_settings['sort-order'] == 'page') echo " selected"; ?>><?php _e( "By Page ID", "affil4you_libs_wptouch2" ); ?></option>
				</select>
				<?php _e( "Menu List Sort Order", "affil4you_libs_wptouch2" ); ?>
			</li>
			</ul>
			<ul class="pages">
			<?php } ?>
			<?php $pages = bnc2_get_pages_for_icons(); ?>
			<?php if ( count( $pages ) ) { ?>
				<?php foreach ( $pages as $page ) { ?>
				<li><span>
						<input class="checkbox" type="checkbox" name="enable_<?php echo $page->ID; ?>"<?php if ( isset( $wptouch2_settings[$page->ID] ) ) echo " checked"; ?> />
						<label class="wptouch2-page-label" for="enable_<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></label>
					</span>
					<select class="page-select" name="icon_<?php echo $page->ID; ?>">
						<?php bnc2_get_icon_drop_down_list( ( isset( $wptouch2_settings[ $page->ID ] ) ? $wptouch2_settings[ $page->ID ] : false ) ); ?>
					</select>

				</li>
				<?php } ?>
			<?php } else { ?>
				<strong ><?php _e( "You have no pages yet. Create some first!", "affil4you_libs_wptouch2" ); ?></strong>
			<?php } ?>
		</ul>
	</div><!-- right-content -->
	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->