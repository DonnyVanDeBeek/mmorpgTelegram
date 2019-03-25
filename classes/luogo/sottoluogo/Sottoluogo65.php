<?php
	//SENTIERO PER LE EVERLASTING HILLS
	Class Sottoluogo65 extends Sottoluogo{
		private $id = 65;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}