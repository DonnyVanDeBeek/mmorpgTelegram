<?php
	//TUNNEL DI GHIACCIO
	Class Sottoluogo105 extends Sottoluogo{
		private $id = 105;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}