<?php
	//CLARISSA
	class Equip246 extends Equip{
		private $equipId = 246;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}