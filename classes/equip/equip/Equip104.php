<?php
	//CAPPELLO DI PAGLIA DA MANOVALE
	class Equip104 extends Equip{
		private $equipId = 104;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}