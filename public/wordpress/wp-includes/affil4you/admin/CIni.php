<?php

/**
 * CIni gestion des fichiers ini
 *
 * @author bary
 */
class CIni {

	const FILE_EXTENSION = '.ini';

	public $zFile;
	private $zFileCamparator;
	private $tzParams;

	/**
	 * Contruit l'objet ini
	 * @param string $_zFile le chemin du  fichier ini
	 */
	public function __construct( $_zFile = '' ) {
		$this->zFileCamparator = $this->zFile = $_zFile;
		$this->tzParams = array( );
	}

	/**
	 * Lecture du fichier ini
	 */
	private function readFile() {
		if ( file_exists($this->zFile) ) {
			$this->tzParams = parse_ini_file($this->zFile, true);
			$this->tzParams = array_map(array($this, 'replace_quote'), $this->tzParams);
		} else {
			// Erreur de lecture du fichier
			die("ini File don't existe " . $this->zFile);
		}
	}

	private function replace_quote($message)
	{
		return str_replace('%QUOTE%', '"', $message);
	}

	/**
	 * Verifie qu'on a deja lue le fichier ini
	 * @return boolean
	 */
	private function fileIsRead() {
		if ( count($this->tzParams) && $this->zFile == $this->zFileCamparator ) {
			return TRUE;
		} else {
			$this->readFile();
			$this->zFileCamparator = $this->zFile;
			return FALSE;
		}
	}

	/**
	 *  Retourne la valeur du section et de la clé dans le fichier ini, la clé selement si fichier uni dimentionnel
	 * @param type $_zSectionKey
	 * @param type $_zKey
	 * @return string $zValue
	 */
	public function getParam( $_zSectionKey, $_zKey = '' ) {
		$this->fileIsRead();
		$zSection = '';
		$zValue = FALSE;
		if ( is_array($_zSectionKey) ) {
			$zSection = $_zSectionKey[ 0 ];
			$zKey = $_zSectionKey[ 1 ];
		} else {
			$zKey = $_zSectionKey;
			if ( $_zKey ) {
				$zSection = $_zSectionKey;
				$zKey = $_zKey;
			}
		}


		if ( $zSection ) {
			if ( isset($this->tzParams[ $zSection ][ $zKey ]) ) {
				$zValue = $this->tzParams[ $zSection ][ $zKey ];
			}
		} else {
			if ( isset($this->tzParams[ $zKey ]) ) {
				$zValue = $this->tzParams[ $zKey ];
			}
		}
		return $zValue;
	}

}

?>
