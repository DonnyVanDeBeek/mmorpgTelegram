<?php
	//PROTEZIONE DA FABBRO
	class Equip250 extends Equip{
		private $equipId = 250;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}