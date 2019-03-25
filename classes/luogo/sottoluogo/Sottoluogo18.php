<?php
	//INGRESSO (PORTE DI ECATE)
	Class Sottoluogo18 extends Sottoluogo{
		private $id = 18;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}