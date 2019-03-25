<?php
	//PIAZZA DEL MERCATO
	Class Sottoluogo20 extends Sottoluogo{
		private $id = 20;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}