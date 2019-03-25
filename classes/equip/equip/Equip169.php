<?php
	//LENTI VERDI
	class Equip169 extends Equip{
		private $equipId = 169;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}