<?php
	//SPADA ECTOPLASMICA
	class Equip244 extends Equip{
		private $equipId = 244;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}