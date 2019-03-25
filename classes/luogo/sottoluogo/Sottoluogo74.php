<?php
	//SENTIERO NORD
	Class Sottoluogo74 extends Sottoluogo{
		private $id = 74;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}