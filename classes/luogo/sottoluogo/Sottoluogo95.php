<?php
	//BETATESTING
	Class Sottoluogo95 extends Sottoluogo{
		private $id = 95;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}