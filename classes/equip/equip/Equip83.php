<?php
	//VESTE DI CINGHIALE
	class Equip83 extends Equip{
		private $equipId = 83;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}