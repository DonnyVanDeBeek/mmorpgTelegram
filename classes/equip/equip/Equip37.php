<?php
	//SPADA DI LEGNO
	class Equip37 extends Equip{
		private $equipId = 37;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}