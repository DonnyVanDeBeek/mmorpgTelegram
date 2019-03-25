<?php
	//COLLANA SI TESTE DI CIPOLLA
	class Equip129 extends Equip{
		private $equipId = 129;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}