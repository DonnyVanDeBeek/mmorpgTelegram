<?php
	//BAR DRAGONS - DORMITORIO
	Class Sottoluogo34 extends Sottoluogo{
		private $id = 34;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}