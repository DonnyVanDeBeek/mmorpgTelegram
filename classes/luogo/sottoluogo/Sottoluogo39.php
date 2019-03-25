<?php
	//OSSERVATORIO ASTRALE - CORTILE
	Class Sottoluogo39 extends Sottoluogo{
		private $id = 39;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}