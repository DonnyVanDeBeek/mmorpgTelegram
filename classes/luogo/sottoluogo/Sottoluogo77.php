<?php
	//GALLERIA GOBLIN (1/4)
	Class Sottoluogo77 extends Sottoluogo{
		private $id = 77;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}