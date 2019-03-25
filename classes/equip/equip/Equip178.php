<?php
	//COLTELLO-ANANAS
	class Equip178 extends Equip{
		private $equipId = 178;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}