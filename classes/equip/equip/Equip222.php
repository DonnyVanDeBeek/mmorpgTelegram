<?php
	//RASOIO SACERDOTALE
	class Equip222 extends Equip{
		private $equipId = 222;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}