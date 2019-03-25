<?php
	//PUGNALE AVVELENATO
	class Equip32 extends Equip{
		private $equipId = 32;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}