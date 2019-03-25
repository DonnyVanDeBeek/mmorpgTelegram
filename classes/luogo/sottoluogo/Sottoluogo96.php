<?php
	//NEVE & GHIACCIO
	Class Sottoluogo96 extends Sottoluogo{
		private $id = 96;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}