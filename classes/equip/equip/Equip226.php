<?php
	//RAPINATORE
	class Equip226 extends Equip{
		private $equipId = 226;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}