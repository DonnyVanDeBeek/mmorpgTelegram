<?php
	//LUNGA RADICE
	class Equip200 extends Equip{
		private $equipId = 200;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}