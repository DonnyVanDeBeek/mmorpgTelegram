<?php
	//TESTAMENTO DEL DIO DEL SANGUE
	class Equip220 extends Equip{
		private $equipId = 220;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}