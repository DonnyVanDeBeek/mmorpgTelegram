<?php
	//ARCO SEMPLICE
	class Equip46 extends Equip{
		private $equipId = 46;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}