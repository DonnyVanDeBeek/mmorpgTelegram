<?php
	//EST
	Class Sottoluogo100 extends Sottoluogo{
		private $id = 100;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}