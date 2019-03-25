<?php
	//SENTIERO PER LA MOONLIT SLOPES
	Class Sottoluogo47 extends Sottoluogo{
		private $id = 47;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}