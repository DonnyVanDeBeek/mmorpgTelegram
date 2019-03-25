<?php
	//INSEGNE DI GADHARAT
	class Equip187 extends Equip{
		private $equipId = 187;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}