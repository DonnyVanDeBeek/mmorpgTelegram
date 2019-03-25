<?php
	//ARTEFATTO BIOMISTICO
	class Equip156 extends Equip{
		private $equipId = 156;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}