<?php
	//MAZZA DA CHIERICO
	class Equip212 extends Equip{
		private $equipId = 212;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}