<?php
	//CIONDOLO PORTAGIOIE
	class Equip88 extends Equip{
		private $equipId = 88;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}