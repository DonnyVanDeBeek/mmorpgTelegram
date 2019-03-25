<?php
	//CORPETTO DI CUOIO
	class Equip149 extends Equip{
		private $equipId = 149;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}