<?php
	//TROTTOLA FATATA
	class Equip182 extends Equip{
		private $equipId = 182;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}