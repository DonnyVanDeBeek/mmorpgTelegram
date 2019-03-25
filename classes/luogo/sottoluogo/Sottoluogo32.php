<?php
	//BAR DRAGONS - SALONE PRINCIPALE
	Class Sottoluogo32 extends Sottoluogo{
		private $id = 32;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}