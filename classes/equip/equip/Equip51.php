<?php
	//GLASS CANNON
	class Equip51 extends Equip{
		private $equipId = 51;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}