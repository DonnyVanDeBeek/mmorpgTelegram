<?php
	//RISERVA DI CACCIA
	Class Sottoluogo71 extends Sottoluogo{
		private $id = 71;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}