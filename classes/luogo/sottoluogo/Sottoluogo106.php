<?php
	//OVEST
	Class Sottoluogo106 extends Sottoluogo{
		private $id = 106;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}