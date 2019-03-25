<?php
	//BENDA DELL'IRA
	class Equip174 extends Equip{
		private $equipId = 174;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}