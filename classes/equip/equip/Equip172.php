<?php
	//SARISSA
	class Equip172 extends Equip{
		private $equipId = 172;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}