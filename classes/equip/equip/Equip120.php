<?php
	//LIBRACCIO DEMONIACO
	class Equip120 extends Equip{
		private $equipId = 120;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}