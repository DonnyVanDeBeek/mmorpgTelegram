<?php
	//ANELLO D'AMBRA
	class Equip231 extends Equip{
		private $equipId = 231;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}