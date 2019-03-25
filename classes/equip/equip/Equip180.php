<?php
	//MAZZETTA BATTICARNE
	class Equip180 extends Equip{
		private $equipId = 180;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}