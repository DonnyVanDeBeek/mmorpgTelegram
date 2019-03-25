<?php
	//GALLEROA GOBLIN (3/4)
	Class Sottoluogo79 extends Sottoluogo{
		private $id = 79;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}