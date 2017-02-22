<div class="wrap">
    <div class="icon32" id="icon-options-general"><br></div><h2><?php pt('admin.affil4you'); ?> - <?php pt('admin.redirect-mode'); ?></h2>

    <form id="affil4you-form" method="post" name="affil4you-form" action="" enctype="multipart/form-data">
		<input name="affil4you_mode_update_setting" type="hidden" value="<?php echo wp_create_nonce('affil4you_mode_update_setting'); ?>" />
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="traffic_redirect"><?php pt('admin.traffic_redirect'); ?></label></th>
                    <td class="ib col2">
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php pt('admin.traffic_redirect'); ?></span></legend>
							<label title="<?php pt('admin.all_traffic_banner'); ?>"><input type="radio" name="traffic_redirect" value="all_traffic_banner" <?php if ( $traffic_redirect == 'all_traffic_banner' ): ?>checked="checked"<?php endif; ?> /><span> <?php pt('admin.all_traffic_banner'); ?></span></label><br>
								<div id="traffic-adult" <?php if ( $traffic_redirect != 'all_traffic_banner' ): ?>style="display:none"<?php endif; ?>>
									<div id="form-adult">
										<label title="<?php pt('admin.accept_adult'); ?>"><input type="radio" name="traffic_accept_adult" value="yes" <?php if ( $traffic_accept_adult == 'yes' ): ?>checked="checked"<?php endif; ?> /><span> <?php pt('admin.accept_adult'); ?></span></label><br>
										<label title="<?php pt('admin.not_accept_adult'); ?>"><input type="radio" name="traffic_accept_adult" value="no" <?php if ( $traffic_accept_adult == 'no' ): ?>checked="checked"<?php endif; ?> /><span> <?php pt('admin.not_accept_adult'); ?></span></label><br>
									</div>
								</div>							
                            <label title="<?php pt('admin.all_traffic'); ?>"><input type="radio" name="traffic_redirect" value="all" <?php if ( $traffic_redirect == 'all' ): ?>checked="checked"<?php endif; ?> /><span> <?php pt('admin.all_traffic'); ?></span></label><br>
							<label title="<?php pt('admin.no_traffic'); ?>"><input type="radio" name="traffic_redirect" value="no" <?php if ( $traffic_redirect == 'no' ): ?>checked="checked"<?php endif; ?> /><span> <?php pt('admin.no_traffic'); ?></span></label><br>
                        </fieldset>
                    </td>
                    <td class="ib">
						<div id="banner-notice" class="a4u_notice" <?php if ( $traffic_redirect != 'all_traffic_banner' ): ?>style="visibility:hidden"<?php endif; ?>>
							<p><?php pt('admin.all_traffic_banner_notice'); ?></p>
						</div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="target_mode"><?php pt('admin.target_mode'); ?></label></th>
                    <td id="col2-target" class="ib col2">
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php pt('admin.target_mode'); ?></span></legend>
                            <div>
                                <label title="<?php pt('admin.optimized_target'); ?>"><input type="radio" name="target_mode" value="optimized_target" <?php if ( $target_mode == 'optimized_target' ): ?>checked="checked"<?php endif; ?>  /><span> <?php pt('admin.optimized_target'); ?></span></label><br>
                                <label title="<?php pt('admin.selected_target'); ?>"><input type="radio" name="target_mode" value="selected_target" <?php if ( $target_mode == 'selected_target' ): ?>checked="checked"<?php endif; ?> /><span> <?php pt('admin.selected_target'); ?></span></label><br>
                                <select id="selected_target" name="target_id" <?php if ( $target_mode == 'optimized_target' ): ?>style="display:none"<?php endif; ?>>
                                    <?php foreach ($targets as $target): ?>
                                        <option value="<?php print $target[ 'id' ]; ?>"<?php if ($target_id == $target['id']): ?>selected="selected"<?php endif; ?> ><?php print $target['name'].' / '.$target['id']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <p class="description"></p>
                        </fieldset>
                    </td>
                    <td class="ib">
						<div id="target-notice" class="a4u_notice">
							<p><?php pt('admin.optimized_target_notice'); ?></p>
						</div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="affil4you-tracker"><?php pt('admin.affil4you-tracker'); ?> :</label></th>
                    <td colspan="2"><input type="text" class="regular-text affil4you-tracker" value="<?php echo $stat_tracker; ?>" id="affil4you-tracker" name="affil4you-tracker">
                        <p class="description"><?php pt('admin.affil4you-tracker.description'); ?></p>
                    </td>
                </tr>
                <?php if ($is_authentified): ?>
                    <tr valign="top">
                    	<?php if (empty($targets)): ?>
	                        <td colspan="3">
	                        	<div class="message message-error">
	                        		<p class="description"><?php pt('admin.no_sites'); ?></p>
	                        	</div>
	                        </td>
                    	<?php else : ?>
	                    	<?php if ('no' == $traffic_redirect): ?>
	                    		<td colspan="3">
	                    			<div class="message message-success">
	                    				<p class="description"><?php pt('admin.traffic_redirect_message.4'); ?></p>
	                    			</div>
	                    		</td>
	                    	<?php else : ?>
	                    		<td colspan="3">
	                    			<div class="message message-success">
	                    				<p class="description"><?php pt('admin.traffic_redirect_message.1'); ?>
											<?php if ( $traffic_redirect == 'all' ): ?>
												<?php
													pt('admin.traffic_redirect_message.3'); echo ' <a id="link-to-target" href="'.Affil4youPlugin::get_redirect_url().'" target="_blank">'.$target_display_name.' / '.$target_id.'</a>';
												?>
											<?php elseif ( $traffic_redirect == 'all_traffic_banner' ): ?>
												<?php pt('admin.traffic_redirect_message.5'); ?>
													<?php if ( $traffic_accept_adult == 'yes' ): ?>
														<?php pt('admin.traffic_redirect_message_adult.1'); ?>
													<?php else : ?>
														<?php pt('admin.traffic_redirect_message_adult.0'); ?>
													<?php endif; ?>
											<?php endif; ?>
										</p>
									</div>
								</td>
	                		<?php endif; ?>
	                	<?php endif; ?>
                    </tr>
                <?php else : ?>
                    <tr valign="top">
                        <td colspan="3">
                        	<div class="message message-error">
                        		<p class="description"><?php pt('admin.affil4you-key.description.1'); ?></p>
                        	</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <p class="submit"><input type="submit" value="<?php pt('admin.btn.submit'); ?>" class="button-primary" id="submit" name="submit" <?php if (!$is_authentified || empty($targets)): ?>disabled="disabled"<?php endif; ?>></p>

		<span id="advanced_collapse">+</span> <a href="#button_advanced_settings" id="button_advanced_settings"><?php pt('admin.advanced_settings'); ?></a>
		<br/><br/>
		<div id="advanced_settings" style="display:<?php echo $style_advanced ?>;">
			<div class="icon32" id="icon-options-general"><br></div><div class="clear"></div>
			<?php if ( sizeof($tzCategory) > 0 ) : ?>
			<p><?php pt('admin.advanced_settings_text'); ?></p>

		<table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
					<b><?php pt('admin.advanced_settings_categorys'); ?></b>
					</th>
					 <th scope="row">
					<b><?php pt('admin.advanced_settings_target'); ?></b>
					</th>
					<th scope="row">
					<b><?php pt('admin.advanced_settings_niche'); ?></b>
					</th>
					<th scope="row">
					<b><?php pt('admin.advanced_settings_tracker'); ?></b>
					</th>
				</tr>
				<?php foreach ($tzCategory as $iCategoryId=>$catName) : ?>
				<tr>
                    <td>
						<?php echo $catName ?>
                    </td>
					<td>
						<select class='affil4you_categories_target_id' name="<?php print 'affil4you_categories_target_id[' . $iCategoryId . ']' ?>" >
							<?php foreach ( $targets as $target ): ?>
								<?php if ( empty($affil4you_categories_target_id[ $iCategoryId ]) ): ?>
									<option value="<?php print $target[ 'id' ]; ?>"<?php if ( $best_target['id'] == $target['id'] ): ?>selected="selected"<?php endif; ?> ><?php print $target[ 'name' ].' / '.$target['id']; ?></option>
								<?php else : ?>
									<option value="<?php print $target[ 'id' ]; ?>"<?php if ( $target[ 'id' ] == $affil4you_categories_target_id[ $iCategoryId ] ): ?>selected="selected"<?php endif; ?> ><?php print $target[ 'name' ].' / '.$target['id']; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
						<select class='affil4you_categories_target_domain' name="<?php print 'affil4you_categories_target_domain[' . $iCategoryId . ']' ?>" >
							<?php foreach ( $targets as $target ): ?>
								<?php if ( empty($affil4you_categories_target_domain[ $iCategoryId ]) ): ?>
									<option value="<?php print htmlentities($target[ 'domain' ]); ?>"<?php if ( $best_target['id'] == $target['id'] ): ?>selected="selected"<?php endif; ?> ><?php print $target[ 'id' ]; ?></option>
								<?php else : ?>
									<option value="<?php print htmlentities($target[ 'domain' ]); ?>"<?php if ( $target[ 'id' ] == $affil4you_categories_target_id[ $iCategoryId ] ): ?>selected="selected"<?php endif; ?> ><?php print $target[ 'id' ]; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
						<select class='affil4you_categories_target_display_name' name="<?php print 'affil4you_categories_target_display_name[' . $iCategoryId . ']' ?>" >
							<?php foreach ( $targets as $target ): ?>
								<?php if ( empty($affil4you_categories_target_display_name[ $iCategoryId ]) ): ?>
									<option value="<?php print htmlentities($target[ 'name' ]); ?>"<?php if ( $best_target['id'] == $target['id'] ): ?>selected="selected"<?php endif; ?> ><?php print $target[ 'id' ]; ?></option>
								<?php else : ?>
									<option value="<?php print htmlentities($target[ 'name' ]); ?>"<?php if ( $target[ 'id' ] == $affil4you_categories_target_id[ $iCategoryId ] ): ?>selected="selected"<?php endif; ?> ><?php print $target[ 'id' ]; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
                    </td>
					<td>
						<?php
							if ($is_authentified && !empty($targets)) {
								if (empty($affil4you_categories_target_id[ $iCategoryId ])) {
									$actual_target = $best_target['id'];
								} else {
									$actual_target = $affil4you_categories_target_id[ $iCategoryId ];
								}
								$niches_list = $web_service->get_niches_list($actual_target, $affil4you_key);
							}
						?>
						<select name="<?php print 'affil4you_categories_niche[' . $iCategoryId . ']' ?>" >
							<?php if ($is_authentified && !empty($targets)): ?>
								<option value=""><?php pt('admin.advanced_settings_all_niches'); ?> </option>
								<?php

								if (!empty($niches_list))
								{
									foreach ( $niches_list as $niche ):
									?>
										<option value="<?php print urlencode($niche[ 'code' ]); ?>"<?php if ( $niche[ 'code' ] == $affil4you_categories_niche[ $iCategoryId ] ): ?>selected="selected"<?php endif; ?> ><?php if (empty($niche['name'][$lang])) { print $niche['name']['en']; } else { print $niche['name'][$lang]; } ?></option>
								<?php
									endforeach;
								}
								?>
							<?php endif; ?>
						</select><span id="load-niche-<?php echo $iCategoryId ?>" style="display:none"><img src="<?php echo compat_get_plugin_url('affil4you').'/images/loading.gif'?>"/></span>
                    </td>
					<td>
						<input id="affil4you-tracker" class="regular-text affil4you-tracker-advanced" type="text" name="affil4you_categories_stat_tracker[<?php print $iCategoryId?>]" value="<?php echo $affil4you_categories_stat_tracker[$iCategoryId] ?>">
                    </td>
                </tr>
				<?php endforeach; ?>
				<?php if ($is_authentified): ?>
                    <tr valign="top">
                    	<?php if (empty($targets)): ?>
	                        <td colspan="4">
	                        	<div class="message message-error">
	                        		<p class="description"><?php pt('admin.no_sites'); ?></p>
	                        	</div>
	                        </td>
                    	<?php elseif (isset($affil4you_categories_target_id) && sizeof($affil4you_categories_target_id) >0 )  : ?>
                    		<td colspan="4">
                    			<div class="message message-success">
                    				<p class="description"><?php pt('admin.advanced_settings_categorys_message'); ?><p>
                    			</div>
                    		</td>
                    	<?php endif; ?>
                    </tr>
                <?php else : ?>
                    <tr valign="top">
                        <td colspan="4">
                        	<div class="message message-error">
                        		<p class="description"><?php pt('admin.affil4you-key.description.1'); ?></p>
                        	</div>
                        </td>
                    </tr>
                <?php endif; ?>

				</tbody>
				</table>
				        <p class="submit"><input type="submit" value="<?php pt('admin.btn.submit'); ?>" class="button-primary" id="submit" name="advanced_submit" <?php if (!$is_authentified || empty($targets)): ?>disabled="disabled"<?php endif; ?>></p>

			 </form>
			<?php else : ?>
				<p><?php echo pt('admin.advanced_settings_text_nocat'); ?></p>
			<?php endif; ?>
		</div>
</div>
<script type="text/javascript">
jQuery("input[name='traffic_redirect']").bind("change", function() {
    if (jQuery(this).val() == "all") {
		jQuery("input[value='selected_target']").trigger("click");
	}
	else if (jQuery(this).val() == "all_traffic_banner") {
		jQuery("input[value='optimized_target']").trigger("click");
	}
});

</script>
