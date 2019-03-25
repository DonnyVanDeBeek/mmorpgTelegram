<?php
	//PORTA CHIODATA
	class Equip36 extends Equip{
		private $equipId = 36;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}