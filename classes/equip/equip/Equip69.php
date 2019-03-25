<?php
	//GAMBA UMANA CHIODATA
	class Equip69 extends Equip{
		private $equipId = 69;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}