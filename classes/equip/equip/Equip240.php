<?php
	//GLIFO DI OPHRAEL
	class Equip240 extends Equip{
		private $equipId = 240;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}