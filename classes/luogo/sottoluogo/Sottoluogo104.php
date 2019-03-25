<?php
	//VILLAGGIO IGLOO
	Class Sottoluogo104 extends Sottoluogo{
		private $id = 104;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}