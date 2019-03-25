<?php
	//FORBICE
	class Equip216 extends Equip{
		private $equipId = 216;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}