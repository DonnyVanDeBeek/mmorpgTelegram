<?php
	//CAPPELLO DA PISTOLERO
	class Equip131 extends Equip{
		private $equipId = 131;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}