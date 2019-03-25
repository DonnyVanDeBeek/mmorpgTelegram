<?php
	//SENTIERO NORD
	Class Sottoluogo82 extends Sottoluogo{
		private $id = 82;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}