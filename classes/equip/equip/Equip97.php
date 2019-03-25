<?php
	//CATENA 
	class Equip97 extends Equip{
		private $equipId = 97;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}