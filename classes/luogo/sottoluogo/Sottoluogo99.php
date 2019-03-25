<?php
	//REAME DEI PINGUINI
	Class Sottoluogo99 extends Sottoluogo{
		private $id = 99;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}