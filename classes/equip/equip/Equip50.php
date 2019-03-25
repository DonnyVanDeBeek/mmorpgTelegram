<?php
	//PELI DI BARBA DI VECCHIA
	class Equip50 extends Equip{
		private $equipId = 50;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}