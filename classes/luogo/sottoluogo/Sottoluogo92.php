<?php
	//ENTRATA ALLA BASILICA DI OHRNALD
	Class Sottoluogo92 extends Sottoluogo{
		private $id = 92;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}