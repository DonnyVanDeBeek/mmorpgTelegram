<?php
	//MATTARELLO DI CARNE
	class Equip134 extends Equip{
		private $equipId = 134;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}