<?php
	//ARPIONE
	class Equip210 extends Equip{
		private $equipId = 210;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}