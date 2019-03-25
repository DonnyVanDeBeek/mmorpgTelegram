<?php
	//CORAZZA DI FERRO
	class Equip196 extends Equip{
		private $equipId = 196;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}