<?php
	//ARTIGLIO DI YVOR
	class Equip136 extends Equip{
		private $equipId = 136;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}