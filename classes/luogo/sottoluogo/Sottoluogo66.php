<?php
	//RISERVA DEI CERVI SACRI
	Class Sottoluogo66 extends Sottoluogo{
		private $id = 66;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}
	}