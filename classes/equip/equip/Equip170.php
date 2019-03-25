<?php
	//KILT
	class Equip170 extends Equip{
		private $equipId = 170;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}