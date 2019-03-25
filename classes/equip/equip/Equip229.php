<?php
	//RELIQUIARIO
	class Equip229 extends Equip{
		private $equipId = 229;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}