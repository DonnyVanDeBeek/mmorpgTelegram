<?php
	//GATTARMATO
	class Equip218 extends Equip{
		private $equipId = 218;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}