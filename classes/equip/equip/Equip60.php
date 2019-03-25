<?php
	//STIVALE FATATO
	class Equip60 extends Equip{
		private $equipId = 60;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}