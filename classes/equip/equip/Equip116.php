<?php
	//SPADA DI VORWING
	class Equip116 extends Equip{
		private $equipId = 116;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}