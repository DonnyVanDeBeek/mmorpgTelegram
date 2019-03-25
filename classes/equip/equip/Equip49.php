<?php
	//LANCIA DI FRASSINO
	class Equip49 extends Equip{
		private $equipId = 49;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}