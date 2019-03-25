<?php
	//SPADA CIPOLLOSA
	class Equip16 extends Equip{
		private $equipId = 16;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}