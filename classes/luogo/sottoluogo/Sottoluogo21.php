<?php
	//CAVERNA FOSFORESCENTE
	Class Sottoluogo21 extends Sottoluogo{
		private $id = 21;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}