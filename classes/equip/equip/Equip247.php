<?php
	//ARMATURA DI BENDE
	class Equip247 extends Equip{
		private $equipId = 247;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}