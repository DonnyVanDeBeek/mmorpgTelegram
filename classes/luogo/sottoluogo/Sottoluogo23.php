<?php
	//GRANDE GABBIA
	Class Sottoluogo23 extends Sottoluogo{
		private $id = 23;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}