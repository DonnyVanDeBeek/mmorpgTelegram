<?php
	//CODA DI LUPO
	class Equip79 extends Equip{
		private $equipId = 79;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}