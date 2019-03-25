<?php
	//BACCHETTA DI PESSIMA FATTURA
	class Equip190 extends Equip{
		private $equipId = 190;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}