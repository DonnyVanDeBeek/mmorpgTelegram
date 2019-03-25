<?php
	//BAR DRAGONS - STANZA 01
	Class Sottoluogo35 extends Sottoluogo{
		private $id = 35;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}