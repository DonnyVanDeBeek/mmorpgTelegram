<?php
	//MACERIE DI UNA ROCCAFORTE
	Class Sottoluogo60 extends Sottoluogo{
		private $id = 60;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}