<?php
	//ALABARBARA
	class Equip39 extends Equip{
		private $equipId = 39;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}