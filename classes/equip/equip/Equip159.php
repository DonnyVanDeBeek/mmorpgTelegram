<?php
	//SCETTRO RIFLETTENTE
	class Equip159 extends Equip{
		private $equipId = 159;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}