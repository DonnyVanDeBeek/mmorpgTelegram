<?php
	//COLTELLO D'OSSO
	class Equip162 extends Equip{
		private $equipId = 162;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}