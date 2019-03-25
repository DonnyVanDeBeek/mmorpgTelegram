<?php
	//CIPOLLA SU BASTONE
	class Equip128 extends Equip{
		private $equipId = 128;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}