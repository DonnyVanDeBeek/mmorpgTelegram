<?php
	//RADURA DEL VECCHIO SALICE
	Class Sottoluogo54 extends Sottoluogo{
		private $id = 54;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}