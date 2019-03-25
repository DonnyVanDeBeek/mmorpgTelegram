<?php
	//OCCHIALI SQUADRATI
	class Equip71 extends Equip{
		private $equipId = 71;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}