<?php
	//SPADA FUOCOFREDDO
	class Equip0 extends Equip{
		private $equipId = 0;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}