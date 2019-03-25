<?php
	//BUFERA
	Class Sottoluogo107 extends Sottoluogo{
		private $id = 107;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}