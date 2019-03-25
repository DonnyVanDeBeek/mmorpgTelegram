<?php
	//DALLA CONIFERA STORTA
	Class Sottoluogo76 extends Sottoluogo{
		private $id = 76;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}