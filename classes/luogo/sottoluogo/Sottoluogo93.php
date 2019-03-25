<?php
	//NPCESP
	Class Sottoluogo93 extends Sottoluogo{
		private $id = 93;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}