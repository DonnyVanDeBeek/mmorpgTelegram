<?php
	//SENTIERO STERRATO
	Class Sottoluogo111 extends Sottoluogo{
		private $id = 111;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}