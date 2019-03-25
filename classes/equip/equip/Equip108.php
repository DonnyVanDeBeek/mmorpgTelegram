<?php
	//NOCCIOLO AETERNO
	class Equip108 extends Equip{
		private $equipId = 108;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}