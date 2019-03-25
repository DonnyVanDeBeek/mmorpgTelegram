<?php
	//PANNO STATICO
	class Equip248 extends Equip{
		private $equipId = 248;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}