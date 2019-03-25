<?php
	//LAUREA
	class Equip237 extends Equip{
		private $equipId = 237;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function effect(){
			$Ut = $this->utente;
			$Ut->giveBuff('SAGGEZZA', 25, 2);
		}
	}