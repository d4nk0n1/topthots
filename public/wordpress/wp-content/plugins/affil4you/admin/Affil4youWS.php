<?php

/**
 * Classe pour le web service Affil4you
 */
class Affil4youWS {

    /**
     * URL du web service principal
     * @var string
     */
    private $main_web_service_url = 'http://partners.wister.biz/affiliation/distrib/wp_affil4you_plugin.php';


	/**
     * URL du web service principal
     * @var string
     */
    private $niche_web_service_url = 'http://partners.wister.biz/affiliation/distrib/wp_affil4you_plugin.php';

    /**
     * URL du web service serveur de bannière
     * @var string
     */
    private $banner_web_service_url = 'http://t4btv.com/affiliation/banners.php';

    /**
     * Objet Reponse
     * @var stdClass
     */
    private $response;

    /**
     * Reponse XML du web service
     * @var string
     */
    private $zXML;

    /**
     * Reponse XML du web service des bannières
     * @var string
     */
    private static $banners;

    /**
     * Executer une requête d'un web service
     *
     * @param string $web_service_url URL du web service
     * @param string $params Tableau associatif contenant les paramètres du web service
     * @return string
     */
    private function do_request($web_service_url, $params = null)
    {
        $response = false;

        if ((!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')) {
            $scheme = 'https';
        } else {
			$scheme = 'http';
		}

		$httpHeaders = array(
			'HTTP_X_FORWARDED_PROTO: '.$scheme,
			'Expect: '
		);
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$httpHeaders[] = 'HTTP_X_FORWARDED_FOR: '.$_SERVER['HTTP_X_FORWARDED_FOR'];
		}

        $url = str_replace('http://', $scheme.'://', $web_service_url).'?'.http_build_query($params);

        if (function_exists('curl_init')) {
        	$c = curl_init();
			$curlParams = array(
				CURLOPT_URL				=> $url,
				CURLOPT_CONNECTTIMEOUT	=> 20,
				CURLOPT_TIMEOUT			=> 180,
				CURLOPT_RETURNTRANSFER	=> true,
				CURLOPT_HTTPHEADER		=> $httpHeaders,
				CURLOPT_HEADER			=> false,
				CURLOPT_REFERER			=> !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
				CURLOPT_FOLLOWLOCATION	=> true,
				CURLOPT_MAXREDIRS		=> 10,
				CURLOPT_SSL_VERIFYPEER	=> false,
				CURLOPT_FRESH_CONNECT	=> true,
				CURLOPT_USERAGENT		=> !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null
			);
			curl_setopt_array($c, $curlParams);
			//trigger_error(var_export($curlParams, true), E_USER_NOTICE);
        	$response = curl_exec($c);
        	curl_close($c);
        }

        $options = array(
            'http'      => array(
                'method'    => 'GET',
                'timeout'   => 180,
                'user_agent'=> !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null,
                'header'	=> implode("\r\n", $httpHeaders)
            )
        );
        $context = stream_context_create($options);

        if (false === $response && function_exists('file_get_contents'))
        {
            $response = file_get_contents($url, false, $context);
        }

        if (false === $response && function_exists('fopen'))
        {
            if ($stream = fopen($url, 'r', false, $context))
            {
                $response = stream_get_contents($stream);
                fclose($stream);
            }
        }

        if (false === $response)
        {
            //echo 'Unable to connect, please verify your configuration.';
        }

    	return $response;
    }

	/**
	 * Appel de la fonction d'authentification
	 * Secondement, il permet de récupérer la liste des cibles de l'affilié
	 *
	 * @param $affiliate_key string Clé Affil4you de l'affilié
	 * @return bool
	 */
    public function connect($affiliate_key = null)
    {
    	if (!empty($affiliate_key))
    	{
    		$params = array(
    			'action'	=> 'auth',
    			'key'		=> $affiliate_key
    		);
    		try
    		{
    			$this->zXML = $this->do_request($this->main_web_service_url, $params);
    			if (!empty($this->zXML))
    			{
    				$ObjectAndXML = new ObjectAndXML();
    				$this->response = $ObjectAndXML->xmlToObj($this->zXML);
    				return true;
    			}
    		}
    		catch (Exception $ex)
    		{
    			echo $ex->getTraceAsString();
    		}
    	}
    	return false;
    }

    /**
     * Récupère la liste des cibles de l'affilié
     * @return string|null Liste des cibles
     */
    public function get_affiliate_id()
    {
        if (isset($this->response->data->affiliate_id))
        {
			return (string) $this->response->data->affiliate_id;
        }
        return null;
    }

	/**
	 * Appel du serveur de bannière
	 * @param int $number
	 * @return string
	 */
    public function get_banner($number)
    {
		if (empty(self::$banners))
		{
	    	$traffic_accept_adult = get_option('affil4you_traffic_accept_adult');
			$level = ($traffic_accept_adult == "yes") ? 'hard' : 'soft';
			$clientIp = $_SERVER['REMOTE_ADDR'];
			if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$clientIp = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				$clientIp = $clientIp[0];
			}
			$redirect_url_params = Affil4youPlugin::get_redirect_url(Affil4youPlugin::RETURN_ONLY_URL_PARAMS_ARRAY);
	    	$params = array(
	    		'ver'			=> '2',
	    		'tokmd5'		=> '8edc8649efa2b4906b137781e40a589e',
	    		'requesttype'	=> 'json',
	    		'qty'			=> '2',
    			'width'			=> 360,
    			'height'		=> 80,
				'level'			=> $level,
				'ua'			=> !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null,
				'lang'			=> Clocale::getLanguage(),
				'ip'			=> $clientIp,
				'oraff'			=> isset($redirect_url_params['codeaff']) ? $redirect_url_params['codeaff'] : null,
				'target_id'		=> isset($redirect_url_params['target_id']) ? $redirect_url_params['target_id'] : null,
				'orstamp'		=> isset($redirect_url_params['stamp']) ? $redirect_url_params['stamp'] : null,
				'niches'		=> isset($redirect_url_params['CodeListe']) ? $redirect_url_params['CodeListe'] : null
	    	);
	    	$response = $this->do_request($this->banner_web_service_url, $params);
	    	if (!empty($response))
	    	{
				self::$banners = json_decode($response, true);
	    	}
		}
		$index = $number - 1;
		if (isset(self::$banners['rdata'][$index]))
		{
			$target_url = self::$banners['rdata'][$index]['target'];
			$image_url = self::$banners['rdata'][$index]['image'];
			$image_alt_text = self::$banners['rdata'][$index]['text'];
			$banner = '
				<div style="text-align:center;clear:both">
					<a href="'.$target_url.'" style="text-decoration:none;display:inline-block;width:100%;">
						<img src="'.$image_url.'" style="border:0 none;width:100%;" alt="'.$image_alt_text.'"/>
					</a>
				</div>
			';
			return $banner;
		}
    	return false;
    }

    /**
     * Recupere le code de retour du web service
     *
     * @return int Code de retour du web service
     */
    public function get_response_code()
    {
    	if (isset($this->response->code))
    	{
    		return (int) $this->response->code;
    	}
        return false;
    }

    /**
     * Indique si le dernier appel web service s'est bien exécuté
     *
     * @return boolean
     */
    public function is_successful_state()
    {
    	return 0 === $this->get_response_code();
    }

    /**
     * Récupère la liste des cibles de l'affilié
     *
     * @return array Liste des cibles
     */
    public function get_targets()
    {
        $sites = array();
        if (isset($this->response->data->sites->site))
        {
			foreach ($this->response->data->sites->site as $site)
			{
				$site = (array) $site;
                if (is_object($site['univers']))
                {
                    $site['univers'] = '';
                }
                $sites[$site['id']] = $site;
			}
        }
        return $sites;
    }

   /**
     * Récupère l'URL premier site (plus visité) de l'affilié
     * @return string URL du site
     */
    public function get_best_target()
    {
    	$site = false;
        $sites = $this->get_targets();
        $best_transfo = -1.0;
        if (!empty($sites)) {
            foreach ($sites as $_site) {
                $transfo = (float) $_site['transfo'];
                if ($transfo > $best_transfo) {
                    $best_transfo = $transfo;
                    $site = $_site;
                }
            }
        }
        return $site;
    }

    public function get_target_by_id($target_id)
    {
        $sites = $this->get_targets();
        if (!empty($sites))
        {
            foreach ($sites as $_site)
            {
                if ($target_id == $_site['id'])
                {
                    return $_site;
                }
            }
        }
        return false;
    }

	/**
	 * Récupère la liste des niches
	 * @param null $target_id
	 * @param null $affiliate_key
	 * @return array|boolean Liste des niches
	 */
    public function get_niches_list($target_id = null, $affiliate_key = null)
    {
		$niche_list = array();
		if (!empty($affiliate_key))
		{
			$params = array(
				'action'	=> 'get_lists',
				'target_id'	=> $target_id,
				'key'		=> $affiliate_key
			);
			try
			{
				$this->zXML = $this->do_request($this->niche_web_service_url, $params);
				$ObjectAndXML = new ObjectAndXML();
				$this->response = $ObjectAndXML->xmlToObj($this->zXML);
			}
			catch (Exception $ex)
			{
				echo $ex->getTraceAsString();
			}
			if (isset($this->response->data->lists->list))
			{
				foreach ($this->response->data->lists->list as $niche) {
					$niche = (array) $niche;
					$niche['name'] = (array) $niche['name'];
					$niche_list[$niche['code']] = $niche;
				}
			}
		}
		return $niche_list;
	}
}
