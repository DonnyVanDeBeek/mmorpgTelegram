<?php
	//STRADA PRINCIPALE DI OSKARIA
	Class Sottoluogo10 extends Sottoluogo{
		private $id = 10;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}