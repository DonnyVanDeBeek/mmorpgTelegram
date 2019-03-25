<?php
	//BOCCALE DI FRATELLO FATTRAG
	class Equip115 extends Equip{
		private $equipId = 115;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}