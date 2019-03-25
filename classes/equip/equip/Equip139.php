<?php
	//VECCHIO BASTONE MUSCHIATO
	class Equip139 extends Equip{
		private $equipId = 139;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}