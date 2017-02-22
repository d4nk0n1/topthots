<?php

if ( ! is_admin() ) {
	die();
}

$web_service = null;
$is_authentified = false;

$affil4you_key = get_option ('affil4you_key');
$traffic_redirect = get_option('affil4you_traffic_redirect');
$target_mode = get_option('affil4you_target_mode');
$target_id = get_option('affil4you_target_id');
$target_display_name = get_option('affil4you_target_display_name');
$target_domain = get_option('affil4you_target_domain');
$stat_tracker = get_option('affil4you_stat_tracker');
$traffic_accept_adult = get_option('affil4you_traffic_accept_adult');
$affil4you_categories_target_id = get_option('affil4you_categories_target_id', array());
$affil4you_categories_niche = get_option('affil4you_categories_niche', array());
$affil4you_categories_stat_tracker = get_option('affil4you_categories_stat_tracker', array());

$targets = array();
$best_target = array();
$niches_list = array();
$lang = CLocale::getLanguage();

//les catégories du blog
$tiCategoryId = Affil4youPlugin::get_all_category_ids();
$tzCategory = array( );
foreach ( $tiCategoryId as $iCategoryId ) {
    $tzCategory[ $iCategoryId ] = get_cat_name($iCategoryId);
}
//on enlève le catégorie par défaut: non classés
unset($tzCategory[ 1 ]);

if (!empty($affil4you_key))
{
	$web_service = new Affil4youWS();
	$web_service->connect($affil4you_key);
	if ($web_service->is_successful_state())
	{
		$is_authentified = true;
		$targets = $web_service->get_targets();
		if (empty($targets))
		{
			update_option('affil4you_target_id', '');
		}
		$best_target = $web_service->get_best_target();
	}
}

if ($is_authentified && (isset($_POST['submit']) || isset($_POST['advanced_submit'])))
{
	if (!isset($_POST['affil4you_mode_update_setting'])) die("<br><br>No CSRF ! ");
	if (!wp_verify_nonce($_POST['affil4you_mode_update_setting'],'affil4you_mode_update_setting')) die("<br><br>you didn't send any credentials.. No CSRF !!!");

	$traffic_redirect = isset($_POST['traffic_redirect']) ? $_POST['traffic_redirect'] : $traffic_redirect;
	$target_mode = isset($_POST['target_mode']) ? $_POST['target_mode'] : $target_mode;
	$target_id = isset($_POST['target_id']) ? $_POST['target_id'] : $target_id;
	$stat_tracker = isset($_POST['affil4you-tracker']) ? trim($_POST['affil4you-tracker']) : $stat_tracker;
	$traffic_accept_adult = isset($_POST['traffic_accept_adult']) ? $_POST['traffic_accept_adult'] : $traffic_accept_adult;

	if ('optimized_target' == $target_mode)
	{
		if (!empty($best_target))
		{
			$target_id = $best_target['id'];
			$target_display_name = $best_target['name'];
			$target_domain = $best_target['domain'];
		}
	}
	else
	{
		$target = $web_service->get_target_by_id($target_id);
		$target_display_name = $target['name'];
		$target_domain = $target['domain'];
	}

	update_option('affil4you_traffic_redirect', $traffic_redirect);
	update_option('affil4you_target_mode', $target_mode);
	update_option('affil4you_traffic_accept_adult', $traffic_accept_adult);
	update_option('affil4you_target_id', $target_id);
	update_option('affil4you_target_display_name', $target_display_name);
	update_option('affil4you_target_domain', $target_domain);
	update_option('affil4you_stat_tracker', $stat_tracker);

	// Soumission formulaire: reglage avancé
	//pour les redictions par catégories
    if ( isset($_POST[ 'affil4you_categories_target_id' ]) && is_array($_POST[ 'affil4you_categories_target_id' ]) )
	{
        $affil4you_categories_target_id = $_POST[ 'affil4you_categories_target_id' ];
        foreach ( $affil4you_categories_target_id as $key => $value ) {
            $affil4you_categories_target_id[ $key ] = $value;
        }
        update_option('affil4you_categories_target_id', $affil4you_categories_target_id);
    } else {
        update_option('affil4you_categories_target_id', array( ));
    }
	// Pour les noms
    if ( isset($_POST[ 'affil4you_categories_target_display_name' ]) && is_array($_POST[ 'affil4you_categories_target_display_name' ]) )
	{
        $affil4you_categories_target_display_name = $_POST[ 'affil4you_categories_target_display_name' ];
        foreach ( $affil4you_categories_target_display_name as $key => $value ) {
            $affil4you_categories_target_display_name[ $key ] = urldecode(html_entity_decode($value));
        }
        update_option('affil4you_categories_target_display_name', $affil4you_categories_target_display_name);
    } else {
        update_option('affil4you_categories_target_display_name', array( ));
    }
    // Pour les noms de domaine
    if ( isset($_POST[ 'affil4you_categories_target_domain' ]) && is_array($_POST[ 'affil4you_categories_target_domain' ]) )
	{
        $affil4you_categories_target_domain = $_POST[ 'affil4you_categories_target_domain' ];
        foreach ( $affil4you_categories_target_domain as $key => $value ) {
            $affil4you_categories_target_domain[ $key ] = urldecode(html_entity_decode($value));
        }
        update_option('affil4you_categories_target_domain', $affil4you_categories_target_domain);
    } else {
        update_option('affil4you_categories_target_domain', array( ));
    }
	//pour les niches
	if ( isset($_POST[ 'affil4you_categories_niche' ]) && is_array($_POST[ 'affil4you_categories_niche' ]) ) {
        $affil4you_categories_niche = $_POST[ 'affil4you_categories_niche' ];
        foreach ( $affil4you_categories_niche as $key => $value ) {
            $affil4you_categories_niche[ $key ] = urldecode($value);
        }
        update_option('affil4you_categories_niche', $affil4you_categories_niche);
    } else {
        update_option('affil4you_categories_niche', array( ));
    }
	//pour les trackings
	if ( isset($_POST[ 'affil4you_categories_stat_tracker' ]) && is_array($_POST[ 'affil4you_categories_stat_tracker' ]) ) {
        $affil4you_categories_stat_tracker = $_POST[ 'affil4you_categories_stat_tracker' ];
        foreach ( $affil4you_categories_stat_tracker as $key => $value ) {
            $affil4you_categories_stat_tracker[ $key ] = urldecode($value);
        }
        update_option('affil4you_categories_stat_tracker', $affil4you_categories_stat_tracker);
    } else {
        update_option('affil4you_categories_stat_tracker', array( ));
    }
}

if (null == $web_service)
{
	$web_service = new affil4youWS();
}

//cacher le reglage avancé par defaut
$style_advanced = "none";
if (isset($_POST['advanced_submit']))
{
	//afficher reglage avancé après modification
	$style_advanced = "block";
}

// affichage du formulaire
require_once 'config_redirect_mode.tpl.php';
?>
