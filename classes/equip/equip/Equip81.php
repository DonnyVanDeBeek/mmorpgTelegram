<?php
	//DURLINDIRINDINA
	class Equip81 extends Equip{
		private $equipId = 81;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}