<?php
	//GRANDE FAGGIO
	Class Sottoluogo27 extends Sottoluogo{
		private $id = 27;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}