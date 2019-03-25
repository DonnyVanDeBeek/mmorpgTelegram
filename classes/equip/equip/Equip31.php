<?php
	//BASTONE CHE SE LO TIENI HAI UN BONUS DI INTELLIGENZA
	class Equip31 extends Equip{
		private $equipId = 31;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}