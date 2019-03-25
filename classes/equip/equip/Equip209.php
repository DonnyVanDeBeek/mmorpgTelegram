<?php
	//ARCO SCHELETRICO
	class Equip209 extends Equip{
		private $equipId = 209;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}