<?php
	//FLAGELLO DEGLI DEI
	class Equip74 extends Equip{
		private $equipId = 74;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}