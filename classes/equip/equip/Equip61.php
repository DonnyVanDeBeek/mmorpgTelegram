<?php
	//SQUARTAFACCE GOBLIN
	class Equip61 extends Equip{
		private $equipId = 61;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}