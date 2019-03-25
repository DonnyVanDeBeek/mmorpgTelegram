<?php
	//RETRO DEL DRAGONS
	Class Sottoluogo94 extends Sottoluogo{
		private $id = 94;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}