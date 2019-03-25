<?php
	//GUANTO DELLE CINQUE PIETRE
	class Equip203 extends Equip{
		private $equipId = 203;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}