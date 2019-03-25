<?php
	//SENTIERO EST
	Class Sottoluogo72 extends Sottoluogo{
		private $id = 72;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}