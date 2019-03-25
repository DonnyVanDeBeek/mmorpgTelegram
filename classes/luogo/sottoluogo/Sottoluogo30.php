<?php
	//VILLA INFESTATA DAI TOPI - SCALE
	Class Sottoluogo30 extends Sottoluogo{
		private $id = 30;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}