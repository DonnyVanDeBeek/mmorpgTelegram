<?php
	//ORIZZONTE GHIACCIATO
	Class Sottoluogo108 extends Sottoluogo{
		private $id = 108;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}