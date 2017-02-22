<?php
if (isset($_GET['device']))
{	
	$uri = (isset($_GET['uri'])) ? $_GET['uri'] : get_bloginfo('wpurl');
	$affil4you_test = get_option('affil4you_test');
	if ($_GET['device'] == "desktop")
	{
		if( $affil4you_test == "desktop")
		{
			update_option('affil4you_test', 'no');
		}
		else
		{
		//update option to desktop
		update_option('affil4you_test', 'desktop');
		}
		//wp_redirect( $uri, 302);
		echo '<script type="text/javascript">window.location = "'.$uri.'" </script>';
	}
	else if ($_GET['device'] == "no-smartphone")
	{
		if( $affil4you_test == "no-smartphone")
		{
			update_option('affil4you_test', 'no');
		}
		else
		{
		//update_option('affil4you_mobile_version_enabled', 'no');
		update_option('affil4you_test', 'no-smartphone');
		}
		//wp_redirect( $uri, 302);
		echo '<script type="text/javascript">window.location = "'.$uri.'" </script>';
	}
	else if ($_GET['device'] == "smartphone")
	{
		if( $affil4you_test == "smartphone")
		{
			update_option('affil4you_test', 'no');
		}
		else
		{
		//update option to smartphone
		update_option('affil4you_test', 'smartphone');
		}
		 //wp_redirect( $uri, 302);
		 echo '<script type="text/javascript">window.location = "'.$uri.'" </script>';
	}
	exit();
}
?>
