<?php
	//PASTORALE SACERDOTALE
	class Equip119 extends Equip{
		private $equipId = 119;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}