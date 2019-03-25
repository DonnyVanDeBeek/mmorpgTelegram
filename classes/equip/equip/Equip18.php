<?php
	//SCUDO DI LEGNO 
	class Equip18 extends Equip{
		private $equipId = 18;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}