<?php
	//NORD
	Class Sottoluogo97 extends Sottoluogo{
		private $id = 97;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}