<?php
	//INGRESSO
	Class Sottoluogo8 extends Sottoluogo{
		private $id = 8;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}