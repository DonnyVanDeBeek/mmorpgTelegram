<?php
	//OUROBOROS
	class Equip194 extends Equip{
		private $equipId = 194;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}