<?php
	//SPADA-FRUSTA
	class Equip124 extends Equip{
		private $equipId = 124;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}