<?php
	//SALOTTO DELLE LENTI DORATE
	Class Sottoluogo16 extends Sottoluogo{
		private $id = 16;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}