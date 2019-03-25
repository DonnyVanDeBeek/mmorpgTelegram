<?php
	//SPADA DI FERRO
	class Equip15 extends Equip{
		private $equipId = 15;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}