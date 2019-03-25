<?php
	//MANTELLA ARCANA
	class Equip166 extends Equip{
		private $equipId = 166;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}