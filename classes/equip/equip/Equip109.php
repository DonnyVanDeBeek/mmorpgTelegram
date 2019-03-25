<?php
	//SPIGA DORATA
	class Equip109 extends Equip{
		private $equipId = 109;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}