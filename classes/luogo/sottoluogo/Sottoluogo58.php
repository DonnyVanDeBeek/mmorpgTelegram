<?php
	//CATAPECCHIA FATISCENTE
	Class Sottoluogo58 extends Sottoluogo{
		private $id = 58;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}