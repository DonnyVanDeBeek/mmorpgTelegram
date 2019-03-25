<?php
	//CAPANNA SOLINGA
	Class Sottoluogo68 extends Sottoluogo{
		private $id = 68;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}