<?php
	//SCORCIATOIA SEGRETA
	Class Sottoluogo109 extends Sottoluogo{
		private $id = 109;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}