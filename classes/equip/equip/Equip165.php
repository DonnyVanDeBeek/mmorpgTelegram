<?php
	//MANTELLO IGNIFUGO
	class Equip165 extends Equip{
		private $equipId = 165;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}