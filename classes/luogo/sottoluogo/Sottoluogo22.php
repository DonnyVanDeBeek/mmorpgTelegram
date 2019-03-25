<?php
	//VILLA INFESTATA DAI TOPI - GIARDINO
	Class Sottoluogo22 extends Sottoluogo{
		private $id = 22;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}