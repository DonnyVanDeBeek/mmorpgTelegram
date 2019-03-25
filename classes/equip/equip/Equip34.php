<?php
	//GUANTO DI PELLE
	class Equip34 extends Equip{
		private $equipId = 34;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}