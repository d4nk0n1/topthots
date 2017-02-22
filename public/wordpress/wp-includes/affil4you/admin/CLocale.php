<?php

/**
 * Description of CLocale
 *
 * @author bary
 */
class CLocale {

    private $zLanguage;
    private $oINI;
    private $oSelector;
    private static $zDefaultLanguage = 'en';
    private static $tzSupportedLanguage = array('en', 'fr', 'de', 'it', 'es', 'pt', 'ru');

    public function __construct() {
        $this->zLanguage = self::getLanguage();
        $this->oINI = new CIni();
    }

    public static function getLanguage()
    {
    	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    	if (empty($lang))
    	{
    		$lang = substr(get_bloginfo("language"), 0, 2);
    	}
        if (in_array($lang, self::$tzSupportedLanguage))
        {
            return $lang;
        }
        return self::$zDefaultLanguage;
    }

    public function translation( $_zSelector ) {
        $this->selector($_zSelector);

        return $this->getParam();
    }

    private function selector( $_zSelector ) {
        $this->oSelector = new stdClass();
        $this->oSelector->zFileName = substr($_zSelector, 0, strpos($_zSelector, '.'));
        $this->oSelector->zParam = str_replace($this->oSelector->zFileName . '.', '', $_zSelector);
        $this->oSelector->zFile = $this->getIniFile();
    }

    private function getIniFile() {
        $zIniFile = realpath(dirname(__FILE__) . '/../locales/' . $this->zLanguage) . '/' . $this->oSelector->zFileName . CIni::FILE_EXTENSION;

        if ( file_exists($zIniFile) ) {
            return $zIniFile;
        } else {
            die('Locale file localisation not existe : ' . $zIniFile);
        }
    }

    private function getParam() {
        $this->oINI->zFile = $this->oSelector->zFile;
        $zValue = $this->oINI->getParam($this->oSelector->zParam);
        if ( $zValue === FALSE ) {
            die('La clé n\' existe pas: ' . $this->oSelector->zParam . ' Fichier : ' . $this->oINI->zFile);
        }
        return $zValue;
    }

}

?>
