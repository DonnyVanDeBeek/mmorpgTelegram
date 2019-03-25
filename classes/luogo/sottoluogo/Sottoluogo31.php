<?php
	//VILLA INFESTATA DAI TOPI - PRIMO PIANO
	Class Sottoluogo31 extends Sottoluogo{
		private $id = 31;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}