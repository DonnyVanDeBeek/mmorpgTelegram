<?php
	//ARMERIA LOBSTER
	Class Sottoluogo12 extends Sottoluogo{
		private $id = 12;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}