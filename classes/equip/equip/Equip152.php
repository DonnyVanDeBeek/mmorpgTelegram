<?php
	//ARMATURA A PIASTRE
	class Equip152 extends Equip{
		private $equipId = 152;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}