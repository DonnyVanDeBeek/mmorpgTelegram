<?php
	//SOTTOLUOGO CANCELLATO
	Class Sottoluogo55 extends Sottoluogo{
		private $id = 55;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}