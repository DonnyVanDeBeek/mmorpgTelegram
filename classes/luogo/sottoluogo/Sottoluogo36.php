<?php
	//BAR DRAGONS - STANZA 02
	Class Sottoluogo36 extends Sottoluogo{
		private $id = 36;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}