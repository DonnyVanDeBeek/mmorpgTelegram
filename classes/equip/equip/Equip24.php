<?php
	//CAPPELLO PIUMATO
	class Equip24 extends Equip{
		private $equipId = 24;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}