<?php
	//SPADONA BRUTTA E CATTIVA
	class Equip80 extends Equip{
		private $equipId = 80;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}