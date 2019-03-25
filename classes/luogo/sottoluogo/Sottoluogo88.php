<?php
	//GALLERIA GOBLIN (3/4)
	Class Sottoluogo88 extends Sottoluogo{
		private $id = 88;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}