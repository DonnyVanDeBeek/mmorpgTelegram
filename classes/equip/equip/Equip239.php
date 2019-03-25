<?php
	//GRANDE MESTOLO DI FABIUS
	class Equip239 extends Equip{
		private $equipId = 239;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}