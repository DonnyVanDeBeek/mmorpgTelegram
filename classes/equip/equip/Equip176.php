<?php
	//CINGHIA DA PISTOLONE
	class Equip176 extends Equip{
		private $equipId = 176;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}