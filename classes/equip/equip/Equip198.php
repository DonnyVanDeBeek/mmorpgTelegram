<?php
	//DE VITA BEATA
	class Equip198 extends Equip{
		private $equipId = 198;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}