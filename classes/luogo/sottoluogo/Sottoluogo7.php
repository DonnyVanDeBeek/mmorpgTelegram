<?php
	//INGRESSO
	Class Sottoluogo7 extends Sottoluogo{
		private $id = 7;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}