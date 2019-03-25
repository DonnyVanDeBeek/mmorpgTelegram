<?php
	//NEGOZIO DI POZIONI DEI FRATELLI JANKOS
	Class Sottoluogo11 extends Sottoluogo{
		private $id = 11;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}