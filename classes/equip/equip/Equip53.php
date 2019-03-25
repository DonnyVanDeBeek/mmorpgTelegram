<?php
	//CLAVA
	class Equip53 extends Equip{
		private $equipId = 53;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}