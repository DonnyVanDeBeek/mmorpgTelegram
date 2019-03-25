<?php
	//VECCHIA BOTTE DI VINO
	class Equip42 extends Equip{
		private $equipId = 42;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}