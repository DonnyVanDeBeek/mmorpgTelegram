<?php
	//CHIAVE INGLESE
	class Equip121 extends Equip{
		private $equipId = 121;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}