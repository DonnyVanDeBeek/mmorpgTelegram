<?php
	//VESTE DEL LUPO BRICCONE
	class Equip77 extends Equip{
		private $equipId = 77;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}