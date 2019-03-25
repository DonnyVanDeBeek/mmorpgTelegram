<?php
	//SCUDO DI FERRO
	class Equip17 extends Equip{
		private $equipId = 17;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}