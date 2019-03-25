<?php
	//FUCILE A LEVA
	class Equip132 extends Equip{
		private $equipId = 132;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}