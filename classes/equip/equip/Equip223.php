<?php
	//SPADA DELLA NONNA
	class Equip223 extends Equip{
		private $equipId = 223;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}