<?php
	//MONOLITE INCISO
	Class Sottoluogo64 extends Sottoluogo{
		private $id = 64;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}