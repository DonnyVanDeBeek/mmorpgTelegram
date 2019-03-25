<?php
	//SPADA INFETTA
	class Equip207 extends Equip{
		private $equipId = 207;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}