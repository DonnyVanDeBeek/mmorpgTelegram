<?php
	//ABETOLE
	Class Sottoluogo44 extends Sottoluogo{
		private $id = 44;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}