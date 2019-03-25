<?php
	//COLTELLO
	class Equip126 extends Equip{
		private $equipId = 126;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}
	}