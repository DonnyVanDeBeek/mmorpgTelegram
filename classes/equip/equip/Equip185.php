<?php
	//INSEGNA DEL DRAGONS SU BASTONE
	class Equip185 extends Equip{
		private $equipId = 185;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}