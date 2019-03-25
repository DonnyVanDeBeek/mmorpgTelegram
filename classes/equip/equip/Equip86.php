<?php
	//SPORE INFETTE
	class Equip86 extends Equip{
		private $equipId = 86;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}