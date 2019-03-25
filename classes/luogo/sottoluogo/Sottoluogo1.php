<?php
	//MASSO GIGANTE
	Class Sottoluogo1 extends Sottoluogo{
		private $id = 1;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}