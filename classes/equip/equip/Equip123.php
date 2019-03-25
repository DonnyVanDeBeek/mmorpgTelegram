<?php
	//PUGNO DI FERRO
	class Equip123 extends Equip{
		private $equipId = 123;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}