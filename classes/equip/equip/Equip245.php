<?php
	//CINGHIA DA BERSERKER
	class Equip245 extends Equip{
		private $equipId = 245;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}