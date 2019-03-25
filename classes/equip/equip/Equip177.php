<?php
	//KRIS
	class Equip177 extends Equip{
		private $equipId = 177;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}