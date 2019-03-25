<?php
	//SCARPONE DI FERRO
	class Equip175 extends Equip{
		private $equipId = 175;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}