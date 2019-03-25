<?php
	//TORCIA
	class Equip100 extends Equip{
		private $equipId = 100;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}