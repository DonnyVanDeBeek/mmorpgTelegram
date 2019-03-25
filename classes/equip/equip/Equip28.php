<?php
	//GUANTO DA CUCINA DI ANGELO PARODI
	class Equip28 extends Equip{
		private $equipId = 28;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}