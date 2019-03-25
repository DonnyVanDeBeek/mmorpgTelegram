<?php
	//RIPETITORE
	class Equip164 extends Equip{
		private $equipId = 164;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}