<?php
	//FRUSTA
	class Equip57 extends Equip{
		private $equipId = 57;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}