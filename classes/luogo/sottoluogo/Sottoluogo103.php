<?php
	//SUD
	Class Sottoluogo103 extends Sottoluogo{
		private $id = 103;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}