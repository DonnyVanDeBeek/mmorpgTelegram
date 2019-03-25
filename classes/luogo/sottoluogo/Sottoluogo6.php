<?php
	//INGRESSO
	Class Sottoluogo6 extends Sottoluogo{
		private $id = 6;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}