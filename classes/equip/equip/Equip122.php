<?php
	//SPIEDO DA CACCIA
	class Equip122 extends Equip{
		private $equipId = 122;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}