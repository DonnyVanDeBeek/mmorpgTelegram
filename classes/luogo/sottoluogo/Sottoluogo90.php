<?php
	//BASILICA SOMMERSA DI IMMUTH
	Class Sottoluogo90 extends Sottoluogo{
		private $id = 90;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}