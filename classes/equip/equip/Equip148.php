<?php
	//COLLANA DI TESTE RINSECCHITE
	class Equip148 extends Equip{
		private $equipId = 148;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}