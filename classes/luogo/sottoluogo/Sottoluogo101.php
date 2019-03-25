<?php
	//GEYSERS
	Class Sottoluogo101 extends Sottoluogo{
		private $id = 101;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}