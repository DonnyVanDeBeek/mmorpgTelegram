<?php
	//BAR DRAGONS - STANZA 04
	Class Sottoluogo38 extends Sottoluogo{
		private $id = 38;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}