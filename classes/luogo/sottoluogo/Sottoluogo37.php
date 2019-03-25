<?php
	//BAR DRAGONS - STANZA 03
	Class Sottoluogo37 extends Sottoluogo{
		private $id = 37;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}