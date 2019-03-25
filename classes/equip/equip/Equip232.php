<?php
	//BOUQUET DI EBRE MEDICINALI
	class Equip232 extends Equip{
		private $equipId = 232;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}