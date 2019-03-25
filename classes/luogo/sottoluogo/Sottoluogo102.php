<?php
	//TANA DEGLI ORSI
	Class Sottoluogo102 extends Sottoluogo{
		private $id = 102;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}