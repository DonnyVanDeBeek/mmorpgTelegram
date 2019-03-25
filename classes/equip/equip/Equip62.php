<?php
	//BRACCIALE DI PELLE BORCHIATA
	class Equip62 extends Equip{
		private $equipId = 62;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}