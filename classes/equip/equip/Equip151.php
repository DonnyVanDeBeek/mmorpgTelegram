<?php
	//BUCKLER
	class Equip151 extends Equip{
		private $equipId = 151;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}