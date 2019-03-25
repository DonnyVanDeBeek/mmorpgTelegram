<?php
	//COLTELLO AD ARTIGLIO DI GATTO
	class Equip161 extends Equip{
		private $equipId = 161;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}