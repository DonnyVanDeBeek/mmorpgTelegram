<?php
	//VECCHIO SCUDO DI LEGNO
	class Equip19 extends Equip{
		private $equipId = 19;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}