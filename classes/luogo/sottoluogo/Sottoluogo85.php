<?php
	//RADURA SELVAGGIA
	Class Sottoluogo85 extends Sottoluogo{
		private $id = 85;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}