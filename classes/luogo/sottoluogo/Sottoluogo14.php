<?php
	//RUSTY BELL
	Class Sottoluogo14 extends Sottoluogo{
		private $id = 14;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}