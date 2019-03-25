<?php
	//BAR DRAGONS - TOILETTE
	Class Sottoluogo33 extends Sottoluogo{
		private $id = 33;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}