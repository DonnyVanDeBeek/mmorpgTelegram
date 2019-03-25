<?php
	//BELLADONNA
	class Equip234 extends Equip{
		private $equipId = 234;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}