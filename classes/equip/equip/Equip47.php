<?php
	//SCUDO TESTA DI CINGHIALE
	class Equip47 extends Equip{
		private $equipId = 47;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}