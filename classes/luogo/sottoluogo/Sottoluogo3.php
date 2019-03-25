<?php
	//PIAZZA MAGICA
	Class Sottoluogo3 extends Sottoluogo{
		private $id = 3;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}