<?php
	//ENTRATA DELLA GALLERIA SOTTERRANEA
	Class Sottoluogo61 extends Sottoluogo{
		private $id = 61;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}