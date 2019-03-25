<?php
	//FASCIA DEL FIGLIO DI LUNA
	class Equip103 extends Equip{
		private $equipId = 103;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}