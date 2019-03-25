<?php
	//SEGUI LA VIA
	Class Sottoluogo87 extends Sottoluogo{
		private $id = 87;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}