<?php
	//TRIDENTE
	class Equip153 extends Equip{
		private $equipId = 153;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}