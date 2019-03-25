<?php
	//LENTI DORATE
	class Equip20 extends Equip{
		private $equipId = 20;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}