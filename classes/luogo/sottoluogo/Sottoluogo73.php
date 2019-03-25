<?php
	//SENTIERO OVEST
	Class Sottoluogo73 extends Sottoluogo{
		private $id = 73;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}