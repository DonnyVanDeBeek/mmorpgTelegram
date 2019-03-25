<?php
	//POLVERE STORDENTE
	class Equip65 extends Equip{
		private $equipId = 65;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}