<?php
	//TANA DEI FUNGUOMINI
	Class Sottoluogo57 extends Sottoluogo{
		private $id = 57;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}