<?php
	//GARGANTUESCA ZUCCA
	class Equip217 extends Equip{
		private $equipId = 217;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}