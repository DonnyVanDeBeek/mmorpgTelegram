<?php
	//PALETTO DI FRASSINO
	class Equip70 extends Equip{
		private $equipId = 70;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}