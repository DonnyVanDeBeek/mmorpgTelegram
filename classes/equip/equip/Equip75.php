<?php
	//MEIN KAMPF
	class Equip75 extends Equip{
		private $equipId = 75;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}