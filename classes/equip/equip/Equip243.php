<?php
	//SCUDO A TORRE
	class Equip243 extends Equip{
		private $equipId = 243;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}