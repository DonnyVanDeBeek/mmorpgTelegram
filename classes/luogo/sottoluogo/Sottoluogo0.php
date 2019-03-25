<?php
	//LOCANDA
	Class Sottoluogo0 extends Sottoluogo{
		private $id = 0;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}