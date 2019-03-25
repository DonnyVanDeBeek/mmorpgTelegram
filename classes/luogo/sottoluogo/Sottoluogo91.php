<?php
	//BASILICA DI OHRNALD
	Class Sottoluogo91 extends Sottoluogo{
		private $id = 91;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}