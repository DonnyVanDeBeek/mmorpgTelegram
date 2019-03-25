<?php
	//BASTONE DEL MASTRO
	class Equip4 extends Equip{
		private $equipId = 4;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}