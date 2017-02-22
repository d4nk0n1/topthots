<?php

if ( ! is_admin() ) {
    die();
}

$affil4you_key = get_option('affil4you_key', null);
$is_authentified = false;
$invalid_key = false;

if (isset($_POST['submit']))
{
    if (!isset($_POST['affil4you_update_setting'])) die("<br><br>No CSRF ! ");
    if (!wp_verify_nonce($_POST['affil4you_update_setting'],'affil4you_update_setting')) die("<br><br>you didn't send any credentials.. No CSRF !!!");
    $affil4you_key = trim($_POST['affil4you-key']);
	//Si la clé st vide on l'insère dans la base pour la désactivation
	if (empty($affil4you_key))
	{
		Affil4youPlugin::init();
	}
    else
    {
        // Verification du code
        $web_service = new Affil4youWS();
        $web_service->connect($affil4you_key);
        if ($web_service->is_successful_state())
        {
        	$is_authentified = true;
            Affil4youPlugin::init();
            update_option('affil4you_key', $affil4you_key);
			update_option('affil4you_affiliate_id', $web_service->get_affiliate_id());
            $target = $web_service->get_best_target();
            update_option('affil4you_target_id', $target['id']);
            update_option('affil4you_target_display_name', $target['name']);
			update_option('affil4you_target_domain', $target['domain']);
        }
        else if (-3 === $web_service->get_response_code())
        {
            $invalid_key = true;
        }
    }
}

if (!empty($affil4you_key) && !$invalid_key)
{
	$is_authentified = true;
}

// affichage du formulaire
require_once 'config_main.tpl.php';
?>
