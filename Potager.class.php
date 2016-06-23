<?php

/**
* Classe de gestion SQL de la table hue liée à la classe Hue
* @author: Valou Tweak <dhomobox@gmail.com>
*/

//La classe Flower hérite de SQLiteEntity qui lui ajoute des méthode de gestion de sa table en bdd (save,delete...)
class Potager extends SQLiteEntity{

	public $id;
	protected $cmd_arrosage, $cmd_engrais; //Pour rajouter des champs il faut ajouter les variables ici...
	protected $TABLE_NAME = 'plugin_potager'; 	//Pensez à mettre le nom de la table sql liée a cette classe
	protected $CLASS_NAME = 'Potager'; //Nom de la classe courante
	protected $object_fields =
	array( // Ici on définit les noms des champs sql de la table et leurs types
		'id'=>'key',
		'cmd_arrosage'=>'string',
		'cmd_engrais'=>'string',
	);

	function __construct(){
		parent::__construct();
	}

	function setId(int $id) {
		$this->id = $id;
	}
	function setCmdArrosage($cmd) {
		$this->cmd_arrosage = $cmd;
	}
	function setCmdEngrais($cmd) {
		$this->cmd_engrais = $cmd;
	}
	function getId() {
		return $this->id;
	}
	function getCmdArrosage() {
		return $this->cmd_arrosage;
	}
	function getCmdEngrais() {
		return $this->cmd_engrais;
	}

}
?>
