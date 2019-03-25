<?php
	//SPECCHIO LIMPIDO
	Class Sottoluogo62 extends Sottoluogo{
		private $id = 62;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}