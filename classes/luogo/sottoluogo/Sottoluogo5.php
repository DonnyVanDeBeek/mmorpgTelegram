<?php
	//INGRESSO
	Class Sottoluogo5 extends Sottoluogo{
		private $id = 5;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}