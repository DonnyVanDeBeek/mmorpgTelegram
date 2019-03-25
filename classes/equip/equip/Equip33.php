<?php
	//GUANTO DI PELLE BORCHIATA
	class Equip33 extends Equip{
		private $equipId = 33;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}