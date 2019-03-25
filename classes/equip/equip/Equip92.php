<?php
	//DIVORATORE DELLA MAGIA
	class Equip92 extends Equip{
		private $equipId = 92;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}