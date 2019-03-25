<?php
	//STENDARDO DI HAURUM
	class Equip184 extends Equip{
		private $equipId = 184;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}