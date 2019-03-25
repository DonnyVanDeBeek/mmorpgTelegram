<?php
	//MASCHERA SCIAMANICA
	class Equip208 extends Equip{
		private $equipId = 208;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}