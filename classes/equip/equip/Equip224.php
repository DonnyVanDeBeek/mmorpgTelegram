<?php
	//SPADONA DELLA NONNA MA QUELLA PATERNA
	class Equip224 extends Equip{
		private $equipId = 224;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}