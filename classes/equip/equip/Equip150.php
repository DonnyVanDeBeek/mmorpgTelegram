<?php
	//CINTURA DI TESTE GOBLIN
	class Equip150 extends Equip{
		private $equipId = 150;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}