<?php
	//GIGANTESCO TRONCO ABBATTUTO
	Class Sottoluogo59 extends Sottoluogo{
		private $id = 59;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}