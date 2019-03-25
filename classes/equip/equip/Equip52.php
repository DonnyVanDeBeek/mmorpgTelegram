<?php
	//CINTURA DI SCAGLIE DI DRAGO
	class Equip52 extends Equip{
		private $equipId = 52;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}