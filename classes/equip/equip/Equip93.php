<?php
	//DIECI DECIMI
	class Equip93 extends Equip{
		private $equipId = 93;

		public function __construct(&$ut, $id){
			$this->utente = $ut;
			parent::__construct($id);
		}
	}