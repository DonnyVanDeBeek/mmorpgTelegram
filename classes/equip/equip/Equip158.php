<?php
	//SCUDO SCIAMANICO
	class Equip158 extends Equip{
		private $equipId = 158;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}