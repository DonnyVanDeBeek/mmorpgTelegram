<?php
	//CASACCA LOGORA
	class Equip219 extends Equip{
		private $equipId = 219;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}