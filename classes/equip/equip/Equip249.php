<?php
	//SCARPETTE VERDI
	class Equip249 extends Equip{
		private $equipId = 249;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}