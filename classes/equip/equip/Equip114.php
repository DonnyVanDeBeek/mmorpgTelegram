<?php
	//MAGLIO DI ULFER
	class Equip114 extends Equip{
		private $equipId = 114;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}