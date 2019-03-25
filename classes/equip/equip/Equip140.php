<?php
	//BACCHETTA DI SALICE SACRO
	class Equip140 extends Equip{
		private $equipId = 140;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}