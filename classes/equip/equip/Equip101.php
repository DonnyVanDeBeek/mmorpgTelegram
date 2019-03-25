<?php
	//COLTELLO FOSFORESCENTE "10000 DEGREE"
	class Equip101 extends Equip{
		private $equipId = 101;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}