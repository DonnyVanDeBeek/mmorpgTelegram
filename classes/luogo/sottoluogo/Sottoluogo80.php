<?php
	//GALLERIA GOBLIN (4/4)
	Class Sottoluogo80 extends Sottoluogo{
		private $id = 80;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}