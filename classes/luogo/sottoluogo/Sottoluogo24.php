<?php
	//FORESTA MALEDETTA 
	Class Sottoluogo24 extends Sottoluogo{
		private $id = 24;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}