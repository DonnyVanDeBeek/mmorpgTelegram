<?php
	//FASCIA DEL TERZO OCCHIO
	class Equip102 extends Equip{
		private $equipId = 102;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}