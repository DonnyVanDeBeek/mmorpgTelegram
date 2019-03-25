<?php
	//MARTELLO DEL TITANO
	class Equip238 extends Equip{
		private $equipId = 238;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}