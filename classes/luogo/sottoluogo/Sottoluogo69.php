<?php
	//SALA DEL TRONO GOBLIN
	Class Sottoluogo69 extends Sottoluogo{
		private $id = 69;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}