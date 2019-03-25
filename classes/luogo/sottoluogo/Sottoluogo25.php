<?php
	//ARENA DEGLI SCHIAVI
	Class Sottoluogo25 extends Sottoluogo{
		private $id = 25;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}