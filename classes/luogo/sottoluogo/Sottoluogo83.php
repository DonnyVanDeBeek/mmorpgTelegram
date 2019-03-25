<?php
	//SENTIERO OVEST
	Class Sottoluogo83 extends Sottoluogo{
		private $id = 83;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}