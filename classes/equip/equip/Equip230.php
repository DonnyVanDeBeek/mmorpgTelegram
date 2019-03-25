<?php
	//ANELLO D'ORO
	class Equip230 extends Equip{
		private $equipId = 230;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}