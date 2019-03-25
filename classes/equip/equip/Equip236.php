<?php
	//CORONCINA FLOREALE
	class Equip236 extends Equip{
		private $equipId = 236;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}