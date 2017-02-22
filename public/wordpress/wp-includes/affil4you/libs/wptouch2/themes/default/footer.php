<div id="footer">
	<?php Affil4youPlugin::front_get_banner(2); ?>

	<center>
		<div id="switch">
			<?php _e( 'Mobile Theme', 'affil4you_libs_wptouch2' ); ?>
			<div>
			<?php wptouch2_core_footer_switch_link(); ?>
			</div>
		</div>
	</center>

	<p><?php $str = wptouch2_custom_footer_msg(); echo stripslashes($str); ?></p>
	<?php if ( bnc2_wptouch2_can_show_powered_by() ) { ?>
		<p><?php _e( 'Powered by', 'affil4you_libs_wptouch2' ); ?> <a href="http://www.wordpress.org/"><?php _e( 'WordPress', 'affil4you_libs_wptouch2' ); ?></a> <?php _e( '+', 'affil4you_libs_wptouch2' ); ?> <a href="http://www.bravenewcode.com/products/wptouch2-pro"><?php WPtouch2(); ?></a></p>
	<?php } ?>
	<?php if ( !bnc2_wptouch2_is_exclusive() ) { wp_footer(); } ?>
</div>

<?php wptouch2_get_stats();
// WPtouch theme designed and developed by Dale Mugford and Duane Storey @ BraveNewCode.com
// If you modify it for yourself, please keep the link credit *visible* in the footer (and keep the WordPress credit, too!) that's all we ask.
?>
</body>
</html>