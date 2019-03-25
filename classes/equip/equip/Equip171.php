<?php
	//ARTIGLIATORE
	class Equip171 extends Equip{
		private $equipId = 171;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}