<?php
	//DAGA DI OSSIDIANA
	class Equip41 extends Equip{
		private $equipId = 41;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}