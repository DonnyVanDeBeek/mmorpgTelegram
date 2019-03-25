<?php
	//BECCO DA MEDICO DELLA PESTE
	class Equip204 extends Equip{
		private $equipId = 204;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}