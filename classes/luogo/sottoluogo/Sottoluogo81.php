<?php
	//SENTIERO EST
	Class Sottoluogo81 extends Sottoluogo{
		private $id = 81;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}