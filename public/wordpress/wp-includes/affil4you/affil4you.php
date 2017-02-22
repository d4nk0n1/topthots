<?php
/*
  Plugin Name: affil4you
  Plugin URI: http://wordpress.org/extend/plugins/affil4you/
  Description: Monetize the mobile audience of your WordPress blog with our plugin!
  Version: 2.5
  Author: affil4you
  Author URI: http://www.affil4you.com
  Credits: The WordPress mobile version use WPtouch by BraveNewCode (http://www.bravenewcode.com/)

  Copyright 2012 affil4you  (email : affiliation.support@wister.fr)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

require_once 'libs/compat.php';
require_once 'admin/CIni.php';
require_once 'admin/CLocale.php';
require_once 'admin/Affil4youWS.php';
require_once 'admin/ObjectAndXML.php';

final class Affil4youPlugin {

	const NAME = 'affil4you';
    const REDIRECT_DOMAIN_NAME = 'http://m.idhad.com';
	const DEFAULT_STAT_TRACKER = 'WP_';

	const RETURN_ONLY_URL_DOMAIN = 1;
	const RETURN_ONLY_URL_PARAMS_ARRAY = 2;
	const RETURN_URL = 3;

	/**
	 * Désactiver le plugin WPTouch
	 */
	public static function deactivate_wptouch_plugin()
	{
		$plugin_desactivated = true;
		$includes_plugin_lib = ABSPATH.'/wp-admin/includes/plugin.php';
		$wptouch_plugin = 'wptouch/wptouch.php';
		if (file_exists($includes_plugin_lib))
		{
			require_once $includes_plugin_lib;
		}
		if (function_exists('is_plugin_active'))
		{
			if (is_plugin_active($wptouch_plugin))
			{
				$plugin_desactivated = false;
			}
		}
		else if (in_array($wptouch_plugin, (array) get_option('active_plugins', array())))
		{
			$plugin_desactivated = false;
		}
		if (!$plugin_desactivated)
		{
			if (function_exists('deactivate_plugins'))
			{
				deactivate_plugins($wptouch_plugin);
			}
		}
	}

	/**
	 * Changer le User-Agent pour tester le comportement du plugin
	 */
	public static function test_affil4you()
	{
		$affil4you_test = get_option('affil4you_test');
		if ( is_super_admin() && $affil4you_test == 'smartphone')
		{
			$_SERVER['HTTP_USER_AGENT'] = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16";
		}
		else if ( is_super_admin() && $affil4you_test == 'desktop')
		{
			$_SERVER['HTTP_USER_AGENT'] = "Mozilla/5.0 (Windows NT 5.1; rv:19.0) Gecko/20100101 Firefox/19.0";
		}
	}

	/**
	 * Inclure le plugin WPTouch
	 */
	public static function include_wptouch_plugin()
	{
		// Si le plugin active le version mobile alors on inclus le plugin WPTouch
		if (self::is_mobile_version_enabled())
		{
			self::deactivate_wptouch_plugin();
			self::test_affil4you();
			require_once 'libs/wptouch2/wptouch.php';
		}
	}

	/**
	 * Retrieve the categories id.
	 */
	public static function get_all_category_ids()
	{
		global $wp_version;
		$categoriesId = null;
		if (version_compare($wp_version, '4.0.0', '<')) {
			$categoriesId = get_all_category_ids();
		} else if (version_compare($wp_version, '4.5.0', '<')) {
			$categoriesId = get_terms('category', array('fields' => 'ids', 'get' => 'all'));
		} else {
			$categoriesId = get_terms(array('taximony' => 'category', 'fields' => 'ids', 'get' => 'all'));
		}
		return $categoriesId;
	}

	/**
	 * Ajouter les options utilisées par le plugin
	 */
	public static function init()
	{
		update_option('affil4you_key', '');
		update_option('affil4you_affiliate_id', '');
		update_option('affil4you_stat_tracker', self::DEFAULT_STAT_TRACKER);
		update_option('affil4you_traffic_redirect', 'all_traffic_banner'); // no | all | all_traffic_banner
		update_option('affil4you_target_mode', 'optimized_target'); // optimized_target | selected_target
		update_option('affil4you_target_id', '');
		update_option('affil4you_target_display_name', '');
		update_option('affil4you_target_domain', '');
		update_option('affil4you_mobile_version_enabled', 'no'); // yes | no
		update_option('affil4you_categories_target_id', '');
		update_option('affil4you_categories_target_display_name', '');
		update_option('affil4you_categories_target_domain', '');
		update_option('affil4you_categories_niche', '');
		$category_ids = self::get_all_category_ids();
		$category_tracker_default = array();
		foreach ($category_ids as $category_id)
		{
			$category_tracker_default[$category_id] = self::DEFAULT_STAT_TRACKER;
		}
		//on enlève le catégorie par défaut: non classés
		unset($category_tracker_default[1]);
		update_option('affil4you_categories_stat_tracker', $category_tracker_default);
		update_option('affil4you_traffic_accept_adult','yes');
		update_option('affil4you_test','');
	}

	/**
	 * Supprimer les options utilisées par le plugin
	 */
	public static function uninstall()
	{
		delete_option('affil4you_key');
		delete_option('affil4you_affiliate_id');
		delete_option('affil4you_stat_tracker');
		delete_option('affil4you_traffic_redirect');
		delete_option('affil4you_target_mode');
		delete_option('affil4you_target_id');
		delete_option('affil4you_target_display_name');
		delete_option('affil4you_target_domain');
		delete_option('affil4you_mobile_version_enabled');
		delete_option('affil4you_categories_target_id');
		delete_option('affil4you_categories_target_display_name');
		delete_option('affil4you_categories_target_domain');
		delete_option('affil4you_categories_niche');
		delete_option('affil4you_categories_stat_tracker');
		delete_option('affil4you_traffic_accept_adult');
		delete_option('affil4you_test');
	}

	/**
	 * Ajouter le code javascript et CSS pour la page de configuration du plugin
	 */
	public static function admin_enqueue_files()
	{
		wp_enqueue_script('affil4you_script', compat_get_plugin_url(Affil4youPlugin::NAME).'/js/affil4you.js?'.time(), array(), false, true);
		wp_enqueue_style('affil4you_style', compat_get_plugin_url(Affil4youPlugin::NAME).'/css/affil4you.css?'.time(), array(), false, 'all');
	}

	/**
	 * Ajouter les menus et sous-menus du plugin dans l'espace d'administration
	 */
	public static function admin_menu()
	{
		add_menu_page ( spt ( 'admin.affil4you' ), spt ( 'admin.affil4you' ), '', 'affil4you_plugin', 'read', plugins_url ( "images/favicona4y.gif", __FILE__ ));
		add_submenu_page ( 'affil4you_plugin', __ ( spt ( 'admin.config' ) ), __ ( spt ( 'admin.config' ) ), 'read', "affil4you_activation", array('Affil4youPlugin', 'admin_config_main_page'));
		add_submenu_page ( 'affil4you_plugin', __ ( spt ( 'admin.redirect-mode' ) ), __ ( spt ( 'admin.redirect-mode' ) ), 'read', "affil4you_redirect_mode", array('Affil4youPlugin', 'admin_config_redirect_mode_page'));
		add_submenu_page ( 'null', __(spt('admin.Test_Affil4you')), __(spt('admin.Test_Affil4you')), 'read', "affil4you_test", array( 'Affil4youPlugin', 'admin_config_test_affil4you' ));
		remove_submenu_page('affil4you_plugin', 'affil4you_plugin');
	}
	/*
	* admin bar pour le test de l'admin
	*/
	public static function admin_bar_menu()
	{
		$affil4you_test = get_option ('affil4you_test');

		global $wp_admin_bar;

		$args = array(
			'id' => 'Test_Affil4you',
			'title' => spt('admin.Test_Affil4you')
		);
		$wp_admin_bar->add_node($args);
		$args = array(
			'id' => 'Test_Affil4you_desktop',
			'title' => spt('admin.Test_Affil4you_desktop'),
			'href' => admin_url().'admin.php?page=affil4you_test&device=desktop&uri='.$_SERVER["REQUEST_URI"],
			'parent' => 'Test_Affil4you',
		);
		if( $affil4you_test == "desktop" )  $args['meta'] = array('class'=> 'device-selected');
		$wp_admin_bar->add_node($args);

		$args = array(
			'id' => 'Test_Affil4you_mobile_smartphone',
			'title' => spt('admin.Test_Affil4you_mobile_smartphone'),
			'href' => admin_url().'admin.php?page=affil4you_test&device=smartphone&uri='.$_SERVER["REQUEST_URI"],
			'parent' => 'Test_Affil4you'
		);
		if( $affil4you_test == "smartphone" )  $args['meta'] = array('class'=> 'device-selected');
		$wp_admin_bar->add_node($args);

		echo '<style type="text/css">#wpadminbar ul li.device-selected{background: #AEFF92;}</style>';
	}

	/**
	 * Inclure l'onglet "Activation du plugin"
	 */
	public static function admin_config_main_page()
	{
		require_once 'admin/config_main.php';
	}

	/**
	 * Inclure l'onglet "Mode de redirection"
	 */
	public static function admin_config_redirect_mode_page()
	{
		require_once 'admin/config_redirect_mode.php';
	}

	/**
	 * Inclure l'onglet "Test affil4you"
	 */
	public static function admin_config_test_affil4you() {
		require_once 'admin/Test_Affil4you.php';
	}

	/**
	 * Récupère l'url de redirection
	 * @param int $return_value
	 * @return array|bool|null|string
	 */
	public static function get_redirect_url($return_value = self::RETURN_URL)
	{
		$domain_name = null;
		$params = array();

		// Récupération du domaine et des paramètres dans le cas d'une configuration de redirection nichée
		$category_id = null;
		if (is_category())
		{
			//echo "c'est une catégorie";
			$category = get_queried_object();
			$category_id = $category->term_id;
		}
		else if (is_single())
		{
			//echo "c'est un post (article)";
			$categories_id = wp_get_post_categories(get_the_ID());
			$rand = array_rand($categories_id);
			$category_id = $categories_id[$rand];
		}
		else
		{
			//echo "c'est autre chose (page, archive, tag, etc.)";
		}
		$redirect_categories_target_id = get_option('affil4you_categories_target_id', array());
		if (isset($redirect_categories_target_id[$category_id]))
		{
			$params['target_id'] = $redirect_categories_target_id[$category_id];

			$redirect_categories_domain = get_option('affil4you_categories_target_domain', array());
			if (!empty($redirect_categories_domain[$category_id])) $domain_name = $redirect_categories_domain[$category_id];

			$redirect_categories_stat_tracker = get_option('affil4you_categories_stat_tracker', array());
			if (!empty($redirect_categories_stat_tracker[$category_id])) $params['stamp'] = $redirect_categories_stat_tracker[$category_id];

			$redirect_categories_niches = get_option('affil4you_categories_niche', array());
			if (!empty($redirect_categories_niches[$category_id])) $params['CodeListe'] = $redirect_categories_niches[$category_id];
		}

		// Si aucune redirection nichée, récupération du domaine et des paramètres d'une configuration globale
		if (empty($params))
		{
			$target_id = get_option('affil4you_target_id');
			if (!empty($target_id))
			{
				if ('optimized_target' == get_option('affil4you_target_mode'))
				{
					$domain_name = self::REDIRECT_DOMAIN_NAME;
					$params['codeaff'] = get_option('affil4you_affiliate_id');
				}
				else
				{
					$domain_name = get_option('affil4you_target_domain');
					if (empty($domain_name)) $domain_name = self::REDIRECT_DOMAIN_NAME;
					$params['target_id'] = $target_id;
				}
				$stat_tracker = get_option('affil4you_stat_tracker');
				if (!empty($stat_tracker)) $params['stamp'] = $stat_tracker;
			}
			else
			{
				return null;
			}
		}

		if (!is_numeric(stripos($domain_name, 'http'))) $domain_name = 'http://'.$domain_name;
		$params['stat_mktg_tracker'] = 'MKTG_REDIRECT_WP';

		switch ($return_value)
		{
			case self::RETURN_ONLY_URL_DOMAIN		: return $domain_name;
			case self::RETURN_ONLY_URL_PARAMS_ARRAY	: return $params;
			case self::RETURN_URL					: return $domain_name.'?'.http_build_query($params);
			default									: return false;
		}
	}

	/**
	 * Enclencher la routine de redirection pour le front-office
	 */
	public static function front_redirect()
	{
		self::test_affil4you();
		$affil4you_key = get_option('affil4you_key');
		if (!is_admin() && !self::is_login_page() && self::is_mobile_device() && !empty($affil4you_key))
		{
			if ('all' == get_option('affil4you_traffic_redirect'))
			{
				$redirect_url = self::get_redirect_url();
				if (!empty($redirect_url))
				{
					wp_redirect($redirect_url, 302);
					exit();
				}
			}
			else if (self::is_mobile_version_enabled())
			{
				self::include_wptouch_plugin();	
			}
		}
	}

	/**
	 * Afficher une bannière pour le front-office du blog
	 * @param int $number
	 */
	public static function front_get_banner($number = 1)
	{
		if (self::is_mobile_version_enabled())
		{
			$web_service = new Affil4youWS();
			$banner = $web_service->get_banner($number);
			if (false !== $banner)
			{
				echo $banner;
			}
		}
	}

	/**
	 * Tester si le terminal est un appareil mobile
	 *
	 * @return boolean
	 */
	public static function is_mobile_device()
	{
		$ua_mobile_list = array(
			'acer','alcatel','amoi','android','asus','avantgo','benq','blackberry','blazer','compal','elaine','ericssont',
			'fennec','googlebot-mobile','hiptop','htc','huawei','iemobile','ipad','ipaq','iphone','ipod','iris','lg-','lg/',
			'lg_','lg1','lg2','lg3','lg4','lg5','lg6','lg7','lg8','lg9','kindle','lge','lenovo','levis','maemo','midp','mmp',
			'mot-','mobilephone','motorola','mtv','nokia','opera mobi', 'opera mini','palm','panasonic','pantech','pg-',
			'philips','pixi/','plucker','pocket','portalmmm','pre/','psp','sagem','samsung','sanyo','sch-','sec-sgh','sendo',
			'sfr','sgh-','sharp','sie-','smartphone','sonyericsson','sph-','sprint','spv','swisscom','symbian','t-mobile',
			'toshiba','treo','up.browser','vk-','vodafone','wap','webos','windows phone','wml','wonu','xda','xiino','zte'
		);
		$current_ua = $_SERVER ['HTTP_USER_AGENT'];
		$affil4you_test = get_option('affil4you_test');
		foreach ($ua_mobile_list as $ua_mobile)
		{
			if (false !== stripos($current_ua, $ua_mobile) || (is_super_admin() && $affil4you_test == "smartphone" ))
			{
				return true;
			}
			if (is_super_admin() && $affil4you_test == "desktop")
			{
				return false;
			}
		}
		return false;
	}

	/**
	 * Tester si le plugin active la version mobile
	 *
	 * @return boolean
	 */
	public static function is_mobile_version_enabled()
	{
		$affil4youKey = get_option('affil4you_key', null);
		if ('all_traffic_banner' == get_option('affil4you_traffic_redirect') && !empty($affil4youKey)) {
			return true;
		}
		return false;
	}

	/**
	 * Tester si l'utilisateur est sur la page de login
	 *
	 * @return boolean
	 */
	public static function is_login_page()
	{
		$request_uri = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : $_SERVER["SCRIPT_URI"];
		if (false !== stripos($request_uri, 'wp-login') || false !== stripos($request_uri, 'wp-register') || false !== stripos($request_uri, 'wp-admin')) {
			return true;
		}
		return false;
	}

	/**
	 * Verifie si le niche est vod et reccupère le target
	 * Fonction pour l'ajax
	 */
	public static function check_niche()
	{
		$target_id = urldecode($_POST['target_id']);
		$web_service = new Affil4youWS();
		$affil4you_key = get_option('affil4you_key');
		$web_service->connect($affil4you_key);
		$arr = null;
		$sites = null;
		if ($web_service->is_successful_state()) {
			$sites = $web_service->get_targets();
			foreach ($sites as $key=>$value) {
				if ($value['id'] == $target_id) {
					$arr = array("target_id"=>$value['id'],"type"=>$value['type']);
				}
			}
		}
		echo json_encode($arr);
		die();
	}

	/**
	 * Obtenir les niches correspondant à un target
	 * Fonction pour l'ajax
	 */
	public static function get_niches_list()
	{
		$lang = CLocale::getLanguage();
		$target_id = $_POST['target_id'];
		$web_service = new Affil4youWS();
		$affil4you_key = get_option('affil4you_key');
		$niche_list = $web_service->get_niches_list($target_id, $affil4you_key);
		echo '<option value="">'.spt('admin.advanced_settings_all_niches').'</option>';
		foreach ($niche_list as $niche) {
			echo '<option value="'.$niche['code'].'">'.(empty($niche['name'][$lang]) ? $niche['name']['en'] : $niche['name'][$lang]).'</option>';
		}
		die();
	}
}


/**
 * function pour la traduction
 *
 * @param string $_zSelector
 * @param string $_tzParams
 * @return string
 */
function spt($_zSelector, $_tzParams = array( )) {
	$oLocale = new CLocale ();
	$zValue = $oLocale->translation ( $_zSelector);
	if (is_array ( $_tzParams )) {
		$zValue = call_user_func_array ( 'sprintf', array_merge ( ( array ) $zValue, $_tzParams ));
	}

	return $zValue;
}

/**
 * function pour afficher la traduction
 *
 * @param string $_zSelector
 * @param string $_tzParams
 * @return string
 */
if (! function_exists ( 'pt' )) {
	function pt($_zSelector, $_tzParams = array( )) {
		print spt ( $_zSelector, $_tzParams);
	}
}

register_activation_hook(__FILE__, array('Affil4youPlugin', 'init'));
register_deactivation_hook(__FILE__, array('Affil4youPlugin', 'uninstall'));

add_action('plugins_loaded', array('Affil4youPlugin', 'include_wptouch_plugin'));
add_action('admin_init', array('Affil4youPlugin', 'deactivate_wptouch_plugin'));
add_action('wp', array('Affil4youPlugin', 'front_redirect'));
add_action('admin_head', array('Affil4youPlugin', 'admin_enqueue_files'));
add_action('admin_menu', array('Affil4youPlugin', 'admin_menu'));
add_action('admin_bar_menu', array('Affil4youPlugin', 'admin_bar_menu'), 999 );
add_action('wp_ajax_check_niche', array('Affil4youPlugin', 'check_niche'));
add_action('wp_ajax_get_niches_list', array('Affil4youPlugin', 'get_niches_list'));

?>