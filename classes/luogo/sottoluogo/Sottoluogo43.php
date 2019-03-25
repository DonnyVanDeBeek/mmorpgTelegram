<?php
	//SPIAZZO ROCCIOSO
	Class Sottoluogo43 extends Sottoluogo{
		private $id = 43;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}