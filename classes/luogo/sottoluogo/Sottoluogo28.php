<?php
	//ALBERI SPETTRALI
	Class Sottoluogo28 extends Sottoluogo{
		private $id = 28;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}