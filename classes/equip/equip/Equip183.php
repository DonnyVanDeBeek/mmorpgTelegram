<?php
	//LANCIA-STENDARDO
	class Equip183 extends Equip{
		private $equipId = 183;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}