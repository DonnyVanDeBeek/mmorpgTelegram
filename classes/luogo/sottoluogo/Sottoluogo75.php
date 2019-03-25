<?php
	//ALBERO DI VEDETTA
	Class Sottoluogo75 extends Sottoluogo{
		private $id = 75;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}