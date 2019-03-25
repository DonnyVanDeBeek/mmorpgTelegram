<?php
	//MAGLIO MARCHIAINFEDELI
	class Equip225 extends Equip{
		private $equipId = 225;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}