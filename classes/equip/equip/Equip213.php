<?php
	//SPINA CAUDALE
	class Equip213 extends Equip{
		private $equipId = 213;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}