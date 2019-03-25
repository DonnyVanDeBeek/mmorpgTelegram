<?php
	//SENTIERO DIMENTICATO
	Class Sottoluogo84 extends Sottoluogo{
		private $id = 84;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}