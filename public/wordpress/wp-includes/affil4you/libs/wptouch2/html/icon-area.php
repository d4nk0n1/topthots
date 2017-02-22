<?php require_once( dirname(__FILE__) . '/../include/icons.php' ); ?>
<?php global $wptouch2_settings; ?>
<script type="text/javascript">
jQuery(document).ready(function(jQuery) {
var button = jQuery('#upload-icon'), interval;
	new AjaxUpload(button, {
		action: '<?php site_url(); ?>/?wptouch2=upload',
		autoSubmit: true,
		name: 'submitted_file',
		onSubmit: function(file, extension) { jQuery("#upload_progress").show(); },
		onComplete: function(file, response) {
		jQuery("#upload_progress").hide();
		jQuery('#upload_response').hide().html(response).fadeIn();
		jQuery('#icon-pool-area').load('<?php echo admin_url( 'options-general.php?page=wptouch2/wptouch2.php' ); ?> #wptouch2icons');
		},
		data: {
			_ajax_nonce: '<?php echo wp_create_nonce('wptouch2-upload'); ?>'
		}
	});
});
</script>
<div class="metabox-holder" id="available_icons">
	<div class="postbox">
		<h3><span class="icon-options">&nbsp;</span><?php _e( "Default &amp; Custom Icon Pool", "affil4you_libs_wptouch2" ); ?></h3>

			<div class="left-content">
				<h4><?php _e( "Adding Icons", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "To add icons to the pool, simply upload a .png, .jpeg or .gif image from your computer.", "affil4you_libs_wptouch2" ); ?></p>
				<p></p>
				<p><?php echo sprintf( __( "Default icons generously provided by %sMarcelo Marfil%s.", "affil4you_libs_wptouch2"), "<a href='http://www.mmarfil.com/' target='_blank'>", "</a>" ); ?></p>

				<h4><?php _e( "Logo/Bookmark Icons", "affil4you_libs_wptouch2" ); ?></h4>
				<p><?php _e( "If you're adding a logo icon, the best dimensions for it are 59x60px (png) when used as a bookmark icon.", "affil4you_libs_wptouch2" ); ?></p>
				<p><?php echo sprintf( __( "Need help? You can use %sthis easy online icon generator%s to make one.", "affil4you_libs_wptouch2"), "<a href='http://wizardtoolkit.com/shooter/iPhone-Icon-Generator' target='_blank'>", "</a>" ); ?></p>
				<p><?php echo sprintf( __( "These files will be stored in this folder we create: .../wp-content/uploads/wptouch2/custom-icons", "affil4you_libs_wptouch2"), '' . compat_get_wp_content_dir( 'affil4you/libs/wptouch2' ). ''); ?></p>
				<p><?php echo sprintf( __( "If an upload fails (usually it's a permission problem) check your wp-content path settings in WordPress' Miscellaneous Settings, or create the folder yourself using FTP and try again.", "affil4you_libs_wptouch2"), "<strong>", "</strong>" ); ?></p>

				<div id="upload-icon" class="button"><?php _e('Upload Icon', 'affil4you_libs_wptouch2' ); ?></div>

			<div id="upload_response"></div>
				<div id="upload_progress" style="display:none">
					<p><img src="<?php echo compat_get_plugin_url( 'affil4you/libs/wptouch2' ) . '/images/progress.gif'; ?>" alt="" /> <?php _e( "Uploading..."); ?></p>
				</div>

			</div><!-- left-content -->

	<div class="right-content" id="icon-pool-area">
	<div id="wptouch2icons">
		<?php bnc2_show_icons(); ?>
	</div>
	</div>

	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->
