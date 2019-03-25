<?php
	//ELMO DI CUOIO
	class Equip127 extends Equip{
		private $equipId = 127;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}