<?php
	//BRACHE DI BORMUNDIL
	class Equip63 extends Equip{
		private $equipId = 63;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}