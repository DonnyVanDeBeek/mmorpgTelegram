<?php
	//EMPORIO DI KALIMIRO
	Class Sottoluogo46 extends Sottoluogo{
		private $id = 46;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}