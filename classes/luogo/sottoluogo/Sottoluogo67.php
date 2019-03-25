<?php
	//COLLE ALPHAR
	Class Sottoluogo67 extends Sottoluogo{
		private $id = 67;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}