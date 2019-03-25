<?php
	//GUARNACCA
	class Equip235 extends Equip{
		private $equipId = 235;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}