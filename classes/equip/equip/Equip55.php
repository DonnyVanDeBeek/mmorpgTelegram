<?php
	//BALESTRA LEGGERA
	class Equip55 extends Equip{
		private $equipId = 55;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}