<?php
	//CARTINA SBIADITA
	class Equip68 extends Equip{
		private $equipId = 68;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}