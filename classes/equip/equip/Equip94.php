<?php
	//RAZIOCINIO E DIPLOMAZIA
	class Equip94 extends Equip{
		private $equipId = 94;

		public function __construct(&$ut, $id){
			$this->utente = $ut;
			parent::__construct($id);
		}
	}