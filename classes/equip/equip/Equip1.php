<?php
	//PUGNALE DA CUCINA
	class Equip1 extends Equip{
		private $equipId = 1;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}