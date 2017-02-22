<?php global $wptouch2_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><span class="style-options">&nbsp;</span><?php _e( "Style &amp; Color Options", "affil4you_libs_wptouch2" ); ?></h3>

			<div class="left-content skins-left-content">
				<p><?php _e( "Here you can customize some of the more visible features of WPtouch.", "affil4you_libs_wptouch2" ); ?></p>
			</div>
		
			<div class="right-content skins-fixed">


 <!-- Default skin -->
 
		<div class="skins-desc" id="default-skin">
			<p><?php _e( "The default WPtouch theme emulates a native iPhone application.", "affil4you_libs_wptouch2" ); ?></p>
			<ul class="wptouch2-make-li-italic">
					<li><select name="style-background">
							<option <?php if ($wptouch2_settings['style-background'] == "crossed-stripes-wptouch2-bg") echo " selected"; ?> value="crossed-stripes-wptouch2-bg">
								<?php _e( "Crossed Stripes (New)", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "fiber-wptouch2-bg") echo " selected"; ?> value="fiber-wptouch2-bg">
								<?php _e( "Fiber (New)", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "light-noise-diagonal-wptouch2-bg") echo " selected"; ?> value="light-noise-diagonal-wptouch2-bg">
								<?php _e( "Light Noise Diagonal (New)", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "low-contrast-linen-wptouch2-bg") echo " selected"; ?> value="low-contrast-linen-wptouch2-bg">
								<?php _e( "Low Contrast Linen (New)", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "random-grey-wptouch2-bg") echo " selected"; ?> value="random-grey-wptouch2-bg">
								<?php _e( "Random Grey (New)", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "stitched-wool-wptouch2-bg") echo " selected"; ?> value="stitched-wool-wptouch2-bg">
								<?php _e( "Stitched Wool (New)", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "white-carbon-wptouch2-bg") echo " selected"; ?> value="white-carbon-wptouch2-bg">
								<?php _e( "White Carbon (New)", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "white-carbon-fiber-wptouch2-bg") echo " selected"; ?> value="white-carbon-fiber-wptouch2-bg">
								<?php _e( "White Carbon Fiber (New)", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "classic-wptouch2-bg") echo " selected"; ?> value="classic-wptouch2-bg">
								<?php _e( "Classic", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "horizontal-wptouch2-bg") echo " selected"; ?> value="horizontal-wptouch2-bg">
								<?php _e( "Horizontal Grey", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "diagonal-wptouch2-bg") echo " selected"; ?> value="diagonal-wptouch2-bg">
								<?php _e( "Diagonal Grey", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "skated-wptouch2-bg") echo " selected"; ?> value="skated-wptouch2-bg">
								<?php _e( "Skated Concrete", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "argyle-wptouch2-bg") echo " selected"; ?> value="argyle-wptouch2-bg">
								<?php _e( "Argyle Tie", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['style-background'] == "grid-wptouch2-bg") echo " selected"; ?> value="grid-wptouch2-bg">
								<?php _e( "Thatches", "affil4you_libs_wptouch2" ); ?>
							</option>
						</select>
						<?php _e( "Background", "affil4you_libs_wptouch2" ); ?>
					</li> 
					<li><select name="h2-font">
							<option <?php if ($wptouch2_settings['h2-font'] == "Helvetica Neue") echo " selected"; ?> value="Helvetica Neue">
								<?php _e( "Helvetica Neue", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['h2-font'] == "Helvetica") echo " selected"; ?> value="Helvetica">
								<?php _e( "Helvetica", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['h2-font'] == "thonburi-font") echo " selected"; ?> value="thonburi-font">
								<?php _e( "Thonburi", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['h2-font'] == "Georgia") echo " selected"; ?> value="Georgia">
								<?php _e( "Georgia", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['h2-font'] == "Geeza Pro") echo " selected"; ?> value="Geeza Pro">
								<?php _e( "Geeza Pro", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['h2-font'] == "Verdana") echo " selected"; ?> value="Verdana">
								<?php _e( "Verdana", "affil4you_libs_wptouch2" ); ?>
							</option>
							<option <?php if ($wptouch2_settings['h2-font'] == "Arial Rounded MT Bold") echo " selected"; ?> value="Arial Rounded MT Bold">
								<?php _e( "Arial Rounded MT Bold", "affil4you_libs_wptouch2" ); ?>
							</option>
							</select>
						<?php _e( "Post Title H2 Font", "affil4you_libs_wptouch2" ); ?>
					</li> 
					<li>#<input type="text" id="header-text-color" name="header-text-color" value="<?php echo $wptouch2_settings['header-text-color']; ?>" /><?php _e( "Title text color", "affil4you_libs_wptouch2" ); ?></li>
					<li>#<input type="text" id="header-background-color" name="header-background-color" value="<?php echo $wptouch2_settings['header-background-color']; ?>" /><?php _e( "Header background color", "affil4you_libs_wptouch2" ); ?></li>
					<li>#<input type="text" id="header-border-color" name="header-border-color" value="<?php echo $wptouch2_settings['header-border-color']; ?>" /><?php _e( "Sub-header background color", "affil4you_libs_wptouch2" ); ?></li>
					<li>#<input type="text" id="link-color" name="link-color" value="<?php echo $wptouch2_settings['link-color']; ?>" /><?php _e( "Site-wide links color", "affil4you_libs_wptouch2" ); ?></li>
			</ul> 
		</div>
		
		</div><!-- right content -->
	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->