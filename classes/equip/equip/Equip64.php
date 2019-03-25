<?php
	//SFERA DI CRISTALLO
	class Equip64 extends Equip{
		private $equipId = 64;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}