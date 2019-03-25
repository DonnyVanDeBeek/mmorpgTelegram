<?php
	//CORAZZA DI LEGNO
	class Equip206 extends Equip{
		private $equipId = 206;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}