<?php
	//TESTA DI ORCO
	class Equip23 extends Equip{
		private $equipId = 23;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}