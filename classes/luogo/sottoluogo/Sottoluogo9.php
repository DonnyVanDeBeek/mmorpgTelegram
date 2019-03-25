<?php
	//INGRESSO OSKARIA
	Class Sottoluogo9 extends Sottoluogo{
		private $id = 9;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}