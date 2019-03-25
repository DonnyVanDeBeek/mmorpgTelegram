<?php
	//VECCHIO SCHIOPPO
	class Equip167 extends Equip{
		private $equipId = 167;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}