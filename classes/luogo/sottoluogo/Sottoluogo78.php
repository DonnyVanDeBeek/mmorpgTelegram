<?php
	//GALLERIA GOBLIN (2/4)
	Class Sottoluogo78 extends Sottoluogo{
		private $id = 78;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}