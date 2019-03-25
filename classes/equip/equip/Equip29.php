<?php
	//BRACCIALE STRATEGICO DI ANGELO PARODI
	class Equip29 extends Equip{
		private $equipId = 29;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}