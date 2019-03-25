<?php
	//GELIDE COLLINE
	Class Sottoluogo98 extends Sottoluogo{
		private $id = 98;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}