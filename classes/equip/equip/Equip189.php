<?php
	//TRINCIA-RENI
	class Equip189 extends Equip{
		private $equipId = 189;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}