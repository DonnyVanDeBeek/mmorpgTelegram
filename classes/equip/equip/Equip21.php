<?php
	//OCCHIALI CON PROTESI DI NASONE BAFFUTO
	class Equip21 extends Equip{
		private $equipId = 21;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}