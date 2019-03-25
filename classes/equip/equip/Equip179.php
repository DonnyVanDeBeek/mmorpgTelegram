<?php
	//BACCHETTA DI SPUMA MARINA
	class Equip179 extends Equip{
		private $equipId = 179;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}