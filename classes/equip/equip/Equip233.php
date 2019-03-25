<?php
	//FETICCIO TRIBALE
	class Equip233 extends Equip{
		private $equipId = 233;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}