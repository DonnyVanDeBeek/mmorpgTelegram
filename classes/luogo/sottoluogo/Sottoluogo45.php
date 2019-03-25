<?php
	//FORESTA STATALE
	Class Sottoluogo45 extends Sottoluogo{
		private $id = 45;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}