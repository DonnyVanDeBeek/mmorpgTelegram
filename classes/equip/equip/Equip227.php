<?php
	//FIORETTO ARGENTEO
	class Equip227 extends Equip{
		private $equipId = 227;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}