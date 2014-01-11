<?php

/*
 @nom: Personnal Settings
 @auteur: Clément Girard 
 @description:  Classer de paramètres personnels
 */

//Ce fichier permet de gerer vos donnees en provenance de la base de donnees

//Il faut changer le nom de la classe ici (je sens que vous allez oublier)
class PluginDC extends SQLiteEntity{

protected $status;
	protected $TABLE_NAME = 'plugin_PluginDC';
	protected $CLASS_NAME = 'PluginDC';
	protected $object_fields = 
	array(
		'status'=>'key'
	);

	function __construct(){
		parent::__construct();
	}

	function setStatus($status){
		$this->status = $status;
	}
}

?>
