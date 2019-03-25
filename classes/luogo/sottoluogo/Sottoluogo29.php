<?php
	//VILLA INFESTATA DAI TOPI - PIANO TERRA
	Class Sottoluogo29 extends Sottoluogo{
		private $id = 29;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}