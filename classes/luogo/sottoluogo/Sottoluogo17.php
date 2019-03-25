<?php
	//PORTALE DI GRANITO
	Class Sottoluogo17 extends Sottoluogo{
		private $id = 17;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}