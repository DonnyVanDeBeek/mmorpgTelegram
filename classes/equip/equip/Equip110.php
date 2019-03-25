<?php
	//PENTOLINO DA BATTAGLIA
	class Equip110 extends Equip{
		private $equipId = 110;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}