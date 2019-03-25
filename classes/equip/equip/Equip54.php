<?php
	//CINTURA DI CUOIO
	class Equip54 extends Equip{
		private $equipId = 54;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}