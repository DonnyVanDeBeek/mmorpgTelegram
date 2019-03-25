<?php
	//INOLTRATI NEL BOSCO
	Class Sottoluogo86 extends Sottoluogo{
		private $id = 86;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}