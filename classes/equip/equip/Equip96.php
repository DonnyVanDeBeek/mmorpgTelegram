<?php
	//CATENACCIO FATATO DELLA RIFRAZIONE DELLE ENERGIE
	class Equip96 extends Equip{
		private $equipId = 96;

		public function __construct(&$ut, $id){
			$this->utente = $ut;
			parent::__construct($id);
		}
	}