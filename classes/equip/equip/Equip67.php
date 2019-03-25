<?php
	//ACCIARINO
	class Equip67 extends Equip{
		private $equipId = 67;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}