<?php
	//SPADA DI FERRO
	class Equip13 extends Equip{
		private $equipId = 13;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}