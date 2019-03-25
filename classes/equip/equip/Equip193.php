<?php
	//STIVALETTO CON LA PUNTA ALL'INSù
	class Equip193 extends Equip{
		private $equipId = 193;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}