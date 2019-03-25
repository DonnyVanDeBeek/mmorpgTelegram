<?php
	//SCUDO DI FERRO
	class Equip14 extends Equip{
		private $equipId = 14;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}